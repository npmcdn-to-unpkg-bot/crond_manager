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
    ];
    public $js = [
        'https://unpkg.com/core-js/client/shim.min.js',
        'https://unpkg.com/zone.js@0.6.12?main=browser',
        'https://unpkg.com/reflect-metadata@0.1.3',
        //'https://unpkg.com/rxjs@5.0.0-beta.6/bundles/Rx.umd.js',
        'https://unpkg.com/systemjs@0.19.27/dist/system.src.js'
        /*'https://unpkg.com/core-js/client/shim.min.js',
        'https://unpkg.com/zone.js@0.6.12?main=browser',
        'https://unpkg.com/reflect-metadata@0.1.3',
        'https://unpkg.com/rxjs@5.0.0-beta.6/bundles/Rx.umd.js',
        'https://unpkg.com/@angular/core/core.umd.js',
        'https://unpkg.com/@angular/common/common.umd.js',
        'https://unpkg.com/@angular/compiler/compiler.umd.js',
        'https://unpkg.com/@angular/platform-browser/platform-browser.umd.js',
        'https://unpkg.com/@angular/platform-browser-dynamic/platform-browser-dynamic.umd.js',
        'https://unpkg.com/systemjs@0.19.27/dist/system.src.js'
        */
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
