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
        $cronFileService = new CronFileService();
        $job = $cronFileService->GetCrontab();
        $this->exportJson($job);
    }


    public function actionGetScripts()
    {
        $cronFileService = new CronFileService();
        $result = $cronFileService->GetScripts();
        $this->exportJson($result);
    }

    public function actionGetScriptContent($fileName)
    {
        $cronFileService = new CronFileService();
        $content = $cronFileService->GetScriptContent($fileName);
        $this->exportJson($content);
    }

    public function actionSaveJob($guid='',$minute='*',$hour='*',$day='*',$month='*',$week='*',$command='',$scriptfile='')
    {
        $cronFileService = new CronFileService();
        $handler = $cronFileService->SaveJob($guid,$minute,$hour,$day,$month,$week,$command,$scriptfile);
        $error = $handler->getError();
        $output = $handler->getOutput();
        if(!empty($error)){
            $this->exportJson([$error],-1,$error,false);
        }
        else{
            $this->exportJson([$output],0,'',true);
        }
    }
}