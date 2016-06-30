<?php
/**
 * Created by lizt
 * Date: 2016/5/31
 * Time: 15:46
 */

namespace app\assets;


class AssetTools extends AssetBase
{
    public $jsOptions = [

        'position' => \yii\web\View::POS_HEAD
    ];

    public $js = [

        'ts/systemjs.config.js',
    ];

    public $depends = [
        'app\assets\AppAsset'
    ];
}