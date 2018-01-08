<?php

$config = [
    'components' => [
        /** ------ 后台操作日志 ------ * */
        'actionlog' => [
            'class' => 'jayfir\basics\common\models\sys\ActionLog',
            'qr' => [
                'class' => '\Da\QrCode\Component\QrCodeComponent',
            // ... you can configure more properties of the component here
            ]
        ],
    ],
    'modules' => [
        /* 系统模块 */
        'sys' => [
            'class' => 'jayfir\basics\backend\modules\sys\Module',
        ],
        /* 微信模块 */
        'wechat' => [
            'class' => 'jayfir\basics\backend\modules\wechat\Module',
        ],
    ],
];

return $config;
