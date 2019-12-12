<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/materialize.min.css',
        
    ];
    public $js = [
        'js/materialize.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
