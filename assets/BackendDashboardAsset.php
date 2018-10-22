<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Hendri <hendri.gnw@gmail.com>
 */
class BackendDashboardAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte';
    public $css = [
        ''
    ];
    public $js = [
        'plugins/jQuery/jquery-2.2.3.min.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
//        'plugins/fastclick/fastclick.js',
//        'dist/js/app.min.js',
//        'dist/js/demo.js',
        'plugins/knob/jquery.knob.js',
        'plugins/sparkline/jquery.sparkline.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
