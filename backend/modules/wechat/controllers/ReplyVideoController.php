<?php
namespace jayfir\basics\backend\modules\wechat\controllers;

use jayfir\basics\common\models\wechat\Rule;
use jayfir\basics\common\models\wechat\ReplyVideo;

/**
 * 视频回复控制器
 *
 * Class ReplyVideoController
 * @package jayfir\basics\backend\modules\wechat\controllers
 */
class ReplyVideoController extends RuleController
{
    public $_module = Rule::RULE_MODULE_VIDEO;

    /**
     * 返回模型
     *
     * @param $id
     * @return array|ReplyVideo|null|\yii\db\ActiveRecord
     */
    protected function findModel($id)
    {
        if (empty($id))
        {
            return new ReplyVideo;
        }

        if (empty(($model = ReplyVideo::find()->where(['rule_id'=>$id])->one())))
        {
            return new ReplyVideo;
        }

        return $model;
    }
}
