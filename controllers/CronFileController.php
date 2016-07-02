<?php
/**
 * Created by PhpStorm.
 * User: zhenyu
 * Date: 2016/7/1
 * Time: 12:57
 */

namespace app\controllers;

use Crontab\Crontab;
use Crontab\Job;
use Symfony\Component\Process\Process;
use app\controllers\BaseController;
use app\common\service\CronFileService;
use app\common\service\SysInfoService;

class CronFileController extends BaseController
{
    public function actionGetCrontab()
    {
        try{
            $cronFileService = new CronFileService();
            $job = $cronFileService->GetCrontab();
            $this->exportJson($job);
        }
        catch(\Exception $ex){
            $this->exportJson([$ex->getMessage()],-1,$ex->getMessage(),false);
        }
    }

    public function actionGetScripts()
    {
        try{
            $cronFileService = new CronFileService();
            $result = $cronFileService->GetScripts();
            $this->exportJson($result);
        }
        catch(\Exception $ex){
            $this->exportJson([$ex->getMessage()],-1,$ex->getMessage(),false);
        }
    }

    public function actionGetJobRecentExcuteSatus($guid)
    {
        try{
            $cronFileService = new CronFileService();
            $result = $cronFileService->GetJobRecentExcuteSatus($guid);
            $this->exportJson($result);
        }
        catch(\Exception $ex){
            $this->exportJson([$ex->getMessage()],-1,$ex->getMessage(),false);
        }
    }
    public function actionGetScriptContent($fileName)
    {
        try{
            $cronFileService = new CronFileService();
            $content = $cronFileService->GetScriptContent($fileName);
            $this->exportJson($content);
        }
        catch(\Exception $ex){
            $this->exportJson([$ex->getMessage()],-1,$ex->getMessage(),false);
        }

    }

    public function actionSaveJob($guid='',$minute='*',$hour='*',$day='*',$month='*',$week='*',$command='',$scriptfile='')
    {
        try{
            $cronFileService = new CronFileService();
            $result = $cronFileService->SaveJob($guid,$minute,$hour,$day,$month,$week,$command,$scriptfile);
            $error = $result['error'];
            $guid = $result['guid'];
        }
        catch(\Exception $ex){
            $error = $ex->getMessage();
        }

        if(!empty($error)){
            $this->exportJson([$error],-1,$error,false);
        }
        else{
            $this->exportJson([$guid],0,'',true);
        }
    }
}