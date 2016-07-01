<?php
/**
 * Created by lizt
 * Date: 2016/5/31
 * Time: 15:45
 */

namespace app\assets;


use yii\web\AssetBundle;

class AssetBase extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}