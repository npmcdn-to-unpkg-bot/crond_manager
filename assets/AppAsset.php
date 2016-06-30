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
        'https://npmcdn.com/core-js/client/shim.min.js',
        'https://npmcdn.com/zone.js@0.6.12?main=browser',
        'https://npmcdn.com/reflect-metadata@0.1.3',
        'https://npmcdn.com/rxjs@5.0.0-beta.6/bundles/Rx.umd.js',
        'https://npmcdn.com/@angular/core/core.umd.js',
        'https://npmcdn.com/@angular/common/common.umd.js',
        'https://npmcdn.com/@angular/compiler/compiler.umd.js',
        'https://npmcdn.com/@angular/platform-browser/platform-browser.umd.js',
        'https://npmcdn.com/@angular/platform-browser-dynamic/platform-browser-dynamic.umd.js',
        'https://npmcdn.com/systemjs@0.19.27/dist/system.src.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
