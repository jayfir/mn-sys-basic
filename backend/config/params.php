<?php
return [
    /** ------ 开发者信息 ------ **/

  'exploitEmail' => 'chinhui@coderfarmer.com',
    'exploitName' => 'jayfir',
    'exploitVersions' => '1.2.0',
    'exploitSysName' => 'JjayFir核心框架',
    'exploitOfficialWebsite' => '<a href="http://www.coderfarmer.com" target="_blank">www.coderfarmer.com</a>',
    'exploitGitHub' => '<a href="https://github.com/jayfir/mn-sys-basic.git" target="_blank">github.com/jayfir/mn-sys-basic.git</a>',
    'exploitGit@OSC' => '<a href="https://git.oschina.net/jayfir/mn-sys-basic.git" target="_blank">git.oschina.net/jayfir/mn-sys-basic.git</a>',
 
    /** ------ 后台网站基础配置 ------ **/

    'siteTitle' => "JayFir", //后台系统名称
    'abbreviation' => "专注业务聚合", //缩写
    'acronym' => "JF", //拼音缩写

    /** ------ 配置管理类型 ------ **/

    'configTypeList' => [
        'text'          => "文本框",
        'password'      => "密码框",
        'secretKeyText' => "密钥文本框",
        'textarea'      => "文本域",
        'dropDownList'  => "下拉文本框",
        'radioList'     => "单选按钮",
        'baiduUEditor'  => "百度编辑器",
        'image'         => "图片上传",
        'images'        => "多图上传",
        'file'          => "文件上传",
        'files'         => "多文件上传",
    ],

    /** ------ 模块类别 ------ **/

    'addonsType'  => [
        'plug-in'   => [
            'name'  => "plug-in",
            'title' => "插件",
            'child' => [
                'plug'      => "功能插件",
            ],
        ],
        'addon'  => [
            'name'  => "addon",
            'title' => "模块",
            'child' => [
                'business'  => "主要业务",
                'customer'  => "客户关系",
                'activity'  => "营销及活动",
                'services'  => "常用服务及工具",
                'biz'       => "行业解决方案",
                'h5game'    => "H5游戏",
                'other'     => "其他",
            ],
        ],
    ],

    /** ------ 禁止删除的后台菜单id ------ **/

    'noDeleteMenu' => [65,108],

    /** ------ 微信配置-------------------**/

    // 素材类型
    'wechatMediaType' => [
        'news'  => '微信图文',
        'image' => '图片',
        'voice' => '语音',
        'video' => '视频',
    ],

    // 微信级别
    'wechatLevel' => [
        '1' => '普通订阅号',
        '2' => '普通服务号',
        '3' => '认证订阅号',
        '4' => '认证服务号/认证媒体/政府订阅号',
    ],

    /** ------ 微信个性化菜单 ------ **/

    // 性别
    'individuationMenuSex' => [
        '' => '全部',
        1 => '男',
        2 => '女',
    ],

    // 客户端版本
    'individuationMenuClientPlatformType' => [
        '' => '全部',
        1 => 'IOS',
        2 => 'Android',
        3 => 'Others',
    ],

    // 语言
    'individuationMenuLanguage' => [
        '简体中文' => 'zh_CN',
        '繁体中文TW' => 'zh_TW',
        '繁体中文HK' => 'zh_HK',
        '英文' => 'en',
        '印尼' => 'id',
        '马来' => 'ms',
        '西班牙' => 'es',
        '韩国' => 'ko',
        '意大利' => 'it',
        '日本' => 'ja',
        '波兰' => 'pl',
        '葡萄牙' => 'pt',
        '俄国' => 'ru',
        '泰文' => 'th',
        '越南' => 'vi',
        '阿拉伯语' => 'ar',
        '北印度' => 'hi',
        '希伯来' => 'he',
        '土耳其' => 'tr',
        '德语' => 'de',
        '法语' => 'fr',
    ],

    /** ------ 无须验证的权限 ------ **/

    // 不需要验证的路由全称
    'basicsNoAuthRoute' => [
        'main/index',// 系统主页
        'main/system',// 系统首页
        'sys/system/index',// 系统入口
        'sys/addons/execute',// 模块插件渲染
        'sys/addons/centre',// 模块插件基础设置渲染
        'sys/addons/qr',// 模块插件二维码渲染
        'sys/addons/cover',// 模块插件导航
        'sys/addons/binding',// 模块插件入口
        'sys/addons-rule/edit',// 模块插件规则管理入口
        'sys/provinces/index',// 省市区联动
        'wechat/default/index',// 微信api
        'wechat/we-code/image',// 微信防盗链获取图片
    ],

    // 不需要验证的方法
    'basicsNoAuthAction' => [
        'upload',// 百度编辑器上传
    ],
];