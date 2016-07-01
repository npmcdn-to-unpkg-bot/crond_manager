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
    }

    public function actionGetCrontabs(){
        $sid = \yii::$app->request->get('id');
        $tag = \yii::$app->request->get('tag');
        $key = \yii::$app->request->get('key');

        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        return json_encode($svr->getCronTabs($sid,$tag,$key));
    }

    public function actionGetTags(){
        $sid = \yii::$app->request->get('id');
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        return json_encode($svr->getTags($sid));
    }

    public function actionEnable(){

        $sid = \yii::$app->request->get('ids');
        $ids = json_decode($sid);
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        foreach($ids as $id){
            $model = $svr->getCronTab($id);

            if(empty($model)){
                continue;
            }

            $model['status'] = '启用';

            $svr->saveCronTab($model);
        }
    }

    public function actionDisable(){
        $sid = \yii::$app->request->get('ids');
        $ids = json_decode($sid);
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        foreach($ids as $id){
            $model = $svr->getCronTab($id);
            if(empty($model)){
                continue;
            }

            $model['status'] = '禁用';
            $svr->saveCronTab($model);
        }
    }

    public function actionDeleteByIds(){
        $sid = \yii::$app->request->get('ids');
        $ids = json_decode($sid);
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        foreach($ids as $id){
           $svr->deleteCronTab($id);
        }
    }
}