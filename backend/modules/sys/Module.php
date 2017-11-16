<?php

namespace jayfir\basics\backend\modules\sys;

/**
 * 系统模块定义类
 * Class Module
 * @package jayfir\basics\backend\modules\sys
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'jayfir\basics\backend\modules\sys\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
