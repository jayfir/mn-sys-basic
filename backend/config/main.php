<?php

$config = [
    'modules' => [
        /* 系统 modules */
        'sys' => [
            'class' => 'jayfir\basics\backend\modules\sys\Module',
        ],
        /* 微信 modules */
        'wechat' => [
            'class' => 'jayfir\basics\backend\modules\wechat\Module',
        ],
    ],
    'components' => [
        /**--------------------*后台操作日志--------------------**/
        'actionlog' => [
            'class' => 'jayfir\basics\common\models\sys\ActionLog',
        ],
    ],
];

return $config;
