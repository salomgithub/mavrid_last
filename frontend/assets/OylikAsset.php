<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class OylikAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery.dataTables.min.css',
        'css/buttons.dataTables.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/jquery-1.12.3.js',
        'js/jquery.dataTables.min.js',
        'js/dataTables.buttons.min.js',
        'js/jszip.min.js',
        'js/buttons.html5.min.js',
        'js/chart.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
