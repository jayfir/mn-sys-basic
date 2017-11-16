<?php
namespace jayfir\basics\backend\widgets\menu;

use yii;
use yii\base\Widget;

/**
 * 插件左边菜单
 * Class AddonLeftWidget
 * @package jayfir\basics\backend\widgets\menu
 */
class AddonLeftWidget extends Widget
{
    public function run()
    {
        return $this->render('addon-left', [
        ]);
    }
}

?>