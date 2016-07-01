<?php
/**
 * Created by lizt
 * Date: 2016/5/31
 * Time: 15:18
 */

namespace app\controllers;


use app\common\service\CrondServerService;
use yii\log\Logger;
use yii\web\Controller;

class ToolsController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }

    public function actionTest(){
        echo 'test123';
    }

    public function actionGetCrondservers(){
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        return json_encode($svr->getCrondServers());
        return json_encode([
            ['id'=>1,'name'=>'te11'],
            ['id'=>2,'name'=>'te12'],
        ]);
    }

    public function actionGetCrontabs(){

    }
}