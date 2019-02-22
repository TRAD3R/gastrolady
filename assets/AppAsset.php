<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/linecons-font-style.css',
        'css/jquery.fs.boxer.css',
        'css/owl.carousel.css',
        'css/animate.css',
        'css/style.css',
        'css/responsive.css',
        'css/custom.css',
    ];
    public $js = [
        'js/modernizr-2.8.0.min.js',
//        'js/jquery-2.1.0.min.js',
        'js/plugins.js',
        'js/jquery.parallax.js',
        'js/wow.min.js',
        'js/functions.js',
        'js/trd_scripts.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
