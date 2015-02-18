<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        '//cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css',
        'libs/datepicker/css/datepicker.css',
    ];
    public $js = [
        '//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js',
        'libs/datepicker/js/bootstrap-datepicker.js',
        'js/site.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
