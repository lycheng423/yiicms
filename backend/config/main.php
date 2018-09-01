<?php
$params = array_merge(
//    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);
/* 需要安装：
 * composer require linslin/yii2-curl
 * composer require kartik-v/yii2-widget-datepicker
 * composer require kucha/ueditor
 * */
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'main',// 默认控制器
    'bootstrap' => [
        'log',
    ],
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => 'r8_heSAXH1IcNoNbeJvqO_viKjMCv_fh',
        ],
        'user' => [
            'identityClass' => 'backend\models\Manager',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['site/login'],
            'idParam' => '__admin',
            'as afterLogin' => 'backend\behaviors\AfterLogin',
        ],
        'session' => [
            'name' => 'advanced-backend',
            'timeout' => 7200
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile'=>'@runtime/logs/sql.log'.date('YmdHi'),
                ],
            ],
        ],
        /** ------ 路由配置 ------ **/
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,  // 这个是生成路由 ?r=site/about--->/site/about
            'showScriptName' => false,
            'suffix' => '.html',// 静态
            'rules' => [

            ],
        ],
        /** ------ 错误定向页 ------ **/
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /** ------ RBAC配置 ------ **/
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        /** ------ 后台操作日志 ------ **/
        'actionlog' => [
            'class' => 'backend\models\ActionLog',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=advance',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ],
        /** ------ 格式化时间 ------ **/
        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CNY',
        ],
        /** ------ 文件缓存配置 ------ **/
        'cache' => [
            // 'class' => 'yii\redis\Cache', // redis缓存
            'class' => 'yii\caching\FileCache',
        ],

    ],
    'params' => $params,
];
