<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Class AppAsset
 * @package backend\assets
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
        '/static/css/bootstrap.min.css?v=3.3.5',
        '/static/css/font-awesome.min.css?v=4.4.0',
        '/static/css/animate.min.css',
        '/static/css/style.css?v=4.1.0',
        '/static/css/plugins/sweetalert/sweetalert.css?v=1',// 弹出框css
        // 复选框样式
        '/static/css/plugins/iCheck/custom.css',
        '/static/css/plugins/iCheck/grey.css',
        '/static/css/base.css',
    ];

    public $js = [
        '/static/js/bootstrap.min.js?v=3.3.5',
        '/static/js/plugins/metisMenu/jquery.metisMenu.js',
        '/static/js/plugins/slimscroll/jquery.slimscroll.min.js',
        '/static/js/plugins/layer/layer.min.js',
        '/static/js/plugins/pace/pace.min.js',
        '/static/js/plugins/sweetalert/sweetalert.min.js',// 弹出框js
        '/static/js/plugins/iCheck/icheck.min.js',// 基础表单js
        '/static/js/hplus.min.js?v=4.0.0',
        '/static/js/contabs.min.js',
        '/static/js/template.js',
        '/static/js/my.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'backend\assets\HeadJsAsset',
    ];
}
