<?php
/**
 * Created by lizt
 * Date: 2016/5/31
 * Time: 15:18
 */

namespace app\controllers;


use app\common\service\CrondServerService;
use app\common\service\OperLogService;
use yii\base\Exception;
use yii\log\Logger;
use yii\web\Controller;

class ToolsController extends BaseController
{
    public $enableCsrfValidation = false;
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
        $svrLst = $svr->getCrondServers();
        foreach($svrLst as &$svrItem){
            $url = $svrItem['api_host'].'/index.php?r=sysinfo/get-sys-info';
            $svrInfo = $svr->request_get($url, []);
            if(empty($svrInfo) || json_decode($svrInfo, true)['retCode'] != '0'){
                continue;
            }
            $svrInfoModel = json_decode($svrInfo, true);
            $svrItem['cpu_model'] = $svrInfoModel['data']['cpu'];
            $svrItem['memory'] = $svrInfoModel['data']['memory'];
            $svrItem['disk'] = $svrInfoModel['data']['disk'];
        }

        return json_encode($svrLst);
    }

    public function actionGetCrondserversStatus(){
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        $svrLst = $svr->getCrondServers();

        foreach($svrLst as $svrItem){
            $url = $svrItem['api_host'].'/index.php?r=sysinfo/get-sys-info';
            $svr->request_get($url, null);
        }
        return json_encode($svrLst);
    }

    public function actionGetCrondServer(){
        $id = \yii::$app->request->get('id');
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        return json_encode($svr->getCrondServer($id));
    }

    public function actionGetCrondScripts(){
        $id = \yii::$app->request->get('id');
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        $svrInfo = $svr->getCrondServer($id);
        $host = $svrInfo['api_host'];
        $url = $host.'/index.php?r=cron-file/get-scripts';
        $scripts = json_decode($svr->request_get($url, []));
        return json_encode($scripts->data);
    }

    public function actionGetCrondScriptContent(){
        $id = \yii::$app->request->get('id');
        $file = \yii::$app->request->get('file');
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        $svrInfo = $svr->getCrondServer($id);
        $host = $svrInfo['api_host'];
        $url = $host.'/index.php?r=cron-file/get-script-content&fileName='.$file;
        $scripts = json_decode($svr->request_get($url, []));
        return json_encode($scripts->data);
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
        try{
            foreach($ids as $id){
                $model = $svr->getCronTab($id);

                if(empty($model)){
                    continue;
                }

                $model['status'] = '启用';

                $svr->saveCronTab($model);
            }

            $this->log('启用任务', OperLogService::OPER_STATUS_SUCC);
        }catch(\Exception $ex){
            $this->log('启用任务', OperLogService::OPER_STATUS_FAILED);
        }

    }

    public function actionDisable(){
        $sid = \yii::$app->request->get('ids');
        $ids = json_decode($sid);
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        try{
            foreach($ids as $id){
                $model = $svr->getCronTab($id);
                if(empty($model)){
                    continue;
                }

                $model['status'] = '禁用';
                $svr->saveCronTab($model);
            }
            $this->log('禁用任务', OperLogService::OPER_STATUS_SUCC);
        }catch(\Exception $ex){
            $this->log('禁用任务', OperLogService::OPER_STATUS_FAILED);
        }

    }

    public function actionDeleteByIds(){
        $sid = \yii::$app->request->get('ids');
        $ids = json_decode($sid);
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        try{
            foreach($ids as $id){
                $svr->deleteCronTab($id);
            }
            $this->log('删除任务', OperLogService::OPER_STATUS_SUCC);
        }catch(\Exception $ex){
            $this->log('删除任务', OperLogService::OPER_STATUS_FAILED);
        }

    }

    public function actionSaveCronTab(){
        $strData = \yii::$app->request->getRawBody();
        $model = json_decode($strData,true);

        //保存脚本
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        $svrInfo = $svr->getCrondServer($model['server_id']);
        $host = $svrInfo['api_host'];
        $frequency = $model['frequency'];
        $freArr = explode(' ', $frequency);
        $url = $host.'/index.php?r=cron-file/save-job';
        $minute=$freArr[0];
        $hour=$freArr[1];
        $day=$freArr[2];
        $month=$freArr[3];
        $week=$freArr[4];
        $file=$model['cron_file'];

        $parm = ['guid'=>$model['jog_guid'],'minute'=>$minute,'hour'=>$hour,'day'=>$day,
            'month'=>$month,'week'=>$week,'command'=>'','scriptfile'=>$file
        ];
        try{
            $result = $svr->request_get($url, $parm);
            $rsTmp = json_decode($result);
            if(empty($rsTmp) || $rsTmp->retCode == '-1'){
                $this->exportJson([], -1, $rsTmp->errMsg);
            }
        }catch(\Exception $ex){
            $this->exportJson([], -1, $ex->getMessage());
        }


        $model['jog_guid'] = $rsTmp->data[0];
        $model['receive'] = $model['receive_mail'];
        /**
         * @var $svr CrondServerService
         */
        $svr = \yii::createObject(CrondServerService::class);
        try{
            $svr->saveCronTab($model);
            $this->log('保存任务', OperLogService::OPER_STATUS_SUCC);
        }catch(\Exception $ex){
            $this->log('保存任务', OperLogService::OPER_STATUS_FAILED);
            $this->exportJson([],-1, $ex->getMessage());
        }

        $this->exportJson([], 0);
    }

    public function actionGetOperLogs(){
        $key = \yii::$app->request->get('key');
        /**
         * @var $svr OperLogService
         */
        $svr = \yii::createObject(OperLogService::class);
        return json_encode($svr->getLogs($key));
    }

    private function log($msg, $status){
        OperLogService::write($msg,'管理员',$status);
    }
}