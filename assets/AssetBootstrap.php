<?php
/**
 * Created by lizt
 * Date: 2016/6/29
 * Time: 10:54
 */

namespace app\assets;


use yii\web\AssetBundle;

class AssetBootstrap extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap4/dist';
    public $css = [
        'css/bootstrap.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        //'js/npm.js',
    ];
}