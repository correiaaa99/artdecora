<?php
namespace backend\assets;
/**
 * Main backend application asset bundle.
 */
use yii\web\AssetBundle;
class AdminLtePluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $js = [
        'datatables/dataTables.bootstrap.min.js',
        // more plugin Js here
    ];
    public $css = [
        'datatables/dataTables.bootstrap.css',
        // more plugin CSS here
        'css/style.css',
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}