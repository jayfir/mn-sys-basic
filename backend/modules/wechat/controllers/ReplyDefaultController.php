<?php
namespace jayfir\basics\backend\modules\wechat\controllers;

use yii;
use jayfir\basics\common\models\wechat\ReplyDefault;

/**
 * 系统回复控制器
 *
 * Class ReplyDefaultController
 * @package jayfir\basics\backend\modules\wechat\controllers
 */
class ReplyDefaultController extends WController
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        $model = $this->findModel();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['index']);
        }

        return $this->render('index',[
            'model'         => $model,
        ]);
    }

    /**
     * 返回模型
     *
     * @return array|ReplyDefault|null|yii\db\ActiveRecord
     */
    protected function findModel()
    {
        if (empty(($model = ReplyDefault::find()->one())))
        {
            return new ReplyDefault;
        }

        return $model;
    }
}
