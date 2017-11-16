<?php
namespace jayfir\basics\backend\modules\wechat\controllers;

use yii;
use yii\data\Pagination;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use jayfir\basics\common\models\wechat\Fans;
use jayfir\basics\common\models\wechat\FansGroups;

/**
 * 粉丝管理
 * Class FansController
 * @package jayfir\basics\backend\modules\wechat\controllers
 */
class FansController extends WController
{
    /**
     * 粉丝首页
     * @return string
     */
    public function actionIndex()
    {
        $request  = Yii::$app->request;
        $follow     = $request->get('follow',1);
        $group_id     = $request->get('group_id','');
        $keyword  = $request->get('keyword','');

        $where = [];
        if($keyword)
        {
            $where = ['or',['like', 'openid', $keyword],['like', 'nickname', $keyword]];
        }

        //关联角色查询
        $data = Fans::find()
            ->with('member')
            ->where($where)
            ->andWhere(['follow' => $follow])
            ->andFilterWhere(['group_id'=> $group_id]);

        $pages  = new Pagination(['totalCount' =>$data->count(), 'pageSize' =>$this->_pageSize]);
        $models = $data->offset($pages->offset)
            ->orderBy('followtime desc,unfollowtime desc')
            ->limit($pages->limit)
            ->all();

        $get_groups = FansGroups::getGroups();
        unset($get_groups[1]);

        return $this->render('index',[
            'models'  => $models,
            'pages'   => $pages,
            'follow'  => $follow,
            'keyword' => $keyword,
            'group_id' => $group_id,
            'all_fans' =>  Fans::find()->andWhere(['follow' => $follow])->count(),
            'fansGroup' => $get_groups,
        ]);
    }

    /**
     * 粉丝详情
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $model = Fans::findOne($id);

        return $this->renderAjax('view',[
            'model' => $model
        ]);
    }

    /**
     * 移动分组
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionMoveUser()
    {
        $request = Yii::$app->request;
        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $result = [];
            $result['flg'] = 2;
            $result['msg'] = "修改失败!";

            $openid    = $request->post('openid');
            $group_id    = $request->post('group_id');

            $this->_app->user_group->moveUser($openid, $group_id);
            $model = Fans::find()->where(['openid'=>$openid])->one();
            $model->group_id = $group_id;
            if($model->save())
            {
                $result['flg'] = 1;
                $result['msg'] = "修改成功!";
            }
            else
            {
                $result['msg'] = $this->analysisError($model->getFirstErrors());
            }

            return $result;
        }
        else
        {
            throw new NotFoundHttpException('请求出错!');
        }
    }

    /**
     * 获取全部粉丝
     */
    public function actionGetAllFans()
    {
        $request = Yii::$app->request;
        $next_openid = $request->get('next_openid','');

        //设置关注全部为为关注
        if (empty($next_openid))
        {
            Fans::updateAll(['follow' => Fans::FOLLOW_OFF ]);
        }

        //获取全部列表
        $fans_list = $this->_app->user->lists();
        $fans_count = $fans_list['total'];

        $total_page = ceil($fans_count / 500);
        for ($i = 0; $i < $total_page; $i++)
        {
            $fans = array_slice($fans_list['data']['openid'], $i * 500, 500);
            //系统内的粉丝
            $system_fans = Fans::find()
                ->where(['in','openid',$fans])
                ->select('openid')
                ->asArray()
                ->all();

            $new_system_fans = [];
            foreach ($system_fans as $li)
            {
                $new_system_fans[$li['openid']] = $li;
            }

            $add_fans = [];
            foreach($fans as $openid)
            {
                if (empty($new_system_fans) || empty($new_system_fans[$openid]))
                {
                    $add_fans[] = [0,$openid,Fans::FOLLOW_ON,0,'',time(),time()];
                }
            }

            if (!empty($add_fans))
            {
                //批量插入数据
                $field = ['member_id', 'openid','follow','followtime','tag','append','updated'];
                Yii::$app->db->createCommand()->batchInsert(Fans::tableName(),$field, $add_fans)->execute();
            }

            //更新当前粉丝为关注
            Fans::updateAll(['follow' =>1 ],['in','openid',$fans]);
        }

        $result = [];
        $result['total'] = $fans_list['total'];
        $result['count'] = !empty($fans_list['data']['openid']) ? $fans_count : 0;
        $result['next_openid'] = $fans_list['next_openid'];

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    /**
     * 开始同步粉丝数据
     */
    public function actionSync()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $type = $request->post('type','') == 'all' ? 'all' : 'check';
        $page = $request->post('page',0);

        //全部同步
        if ($type == 'all')
        {
            $limit = 10;
            $offset = $limit * $page;

            //关联角色查询
            $data = Fans::find()->where(['follow' => 1]);
            $models = $data->offset($offset)
                ->orderBy('id desc')
                ->limit($limit)
                ->asArray()
                ->all();

            if(!empty($models))
            {
                //同步粉丝信息
                foreach ($models as $fans)
                {
                    Fans::sync($fans['openid'],$this->_app);
                }

                $result['flg'] = 1;
                $result['msg'] = "同步成功!";
                $result['page'] = $page + 1;
                return $result;
            }

            $result['flg'] = 2;
            $result['msg'] = "同步完成!";
            return $result;
        }

        //选中同步
        if ($type == 'check')
        {
            $openids = $request->post('openids');
            if (empty($openids) || !is_array($openids))
            {
                $result['flg'] = 2;
                $result['msg'] = "请选择粉丝!";
                return $result;
            }

            //系统内的粉丝
            $sync_fans = Fans::find()
                ->where(['in','openid',$openids])
                ->asArray()
                ->all();

            if (!empty($sync_fans))
            {
                //同步粉丝信息
                foreach ($sync_fans as $fans)
                {
                    Fans::sync($fans['openid'],$this->_app);
                }
            }

            $result['flg'] = 2;
            $result['msg'] = "同步成功!";
            return $result;
        }
    }
}