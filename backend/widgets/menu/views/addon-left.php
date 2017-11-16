<?php
use yii\helpers\Url;
use jayfir\basics\common\models\sys\AddonsBinding;
use common\helpers\AddonsUrl;
use common\enums\StatusEnum;

?>

<div class="ibox-content">
    <div class="file-manager">
        <?php if(Yii::$app->params['addon']['info']['setting'] == StatusEnum::ENABLED || !empty($list[AddonsBinding::ENTRY_COVER])){ ?>
            <h4> 核心设置</h4>
            <ul class="folder-list" style="padding: 10px;">
                <li>
                    <a href="<?php echo Url::to(['cover','addon'=> Yii::$app->params['addon']['info']['name']])?>" title="应用入口">
                        <i class="fa fa-arrow-circle-right"></i>
                        应用入口
                    </a>
                </li>
                <?php if(Yii::$app->params['addon']['info']['setting'] == StatusEnum::ENABLED){ ?>
                    <li>
                        <a href="<?php echo AddonsUrl::toRoot(['setting/display','addon'=> Yii::$app->params['addon']['info']['name']])?>" title="参数设置">
                            <i class="fa fa-cog"></i>
                            参数设置
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
        <h4> 业务菜单</h4>
        <ul class="folder-list" style="padding: 10px;">
            <?php foreach (Yii::$app->params['addon']['binding'][AddonsBinding::ENTRY_MENU] as $vo){ ?>
                <li>
                    <a href="<?php echo AddonsUrl::to([$vo['route'],'addon'=> Yii::$app->params['addon']['info']['name']])?>" title="<?php echo $vo['title'] ?>">
                        <i class="<?php echo $vo['icon'] ? $vo['icon'] : 'fa fa-puzzle-piece';?>"></i>
                        <?php echo $vo['title'] ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>