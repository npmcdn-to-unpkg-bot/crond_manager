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
use yii\helpers\StringHelper;

class TestController extends BaseController
{
    /**
     *
     */
    public function actionTest(){
        $job = new Job();
        $job
            ->setMinute('*/5')
            ->setHour('*')
            ->setDayOfMonth('*')
            ->setMonth('1,6')
            ->setDayOfWeek('*')
            ->setCommand('test2')
        ;

        $crontab = new Crontab();
        $crontab->addJob($job);
        $handler = $crontab->write();
        echo '1';
        echo $handler->getError();
        echo $handler->getOutput();
    }

    public function actionTest2(){
        $process = new Process("more /proc/cpuinfo |grep -i model");
        $process->run();

        echo $process->getErrorOutput();
        echo $process->getOutput();
    }

    public function actionGetSysInfo()
    {
         //CPU
        $process = new Process("more /proc/cpuinfo |grep -i model");
        $process->run();
        $error = $process->getErrorOutput();
        $output = $process->getOutput();

        $cpuInfo = '';
        if (!empty($error)) {
            $cpuInfo = $error;
        }else if (preg_match("/model name\s*:\s*(.*)/i", $output, $match)) {
            $cpuInfo = $match[1];
        } else {
            $cpuInfo = '无法获取';
        }

        //内存
        $process = new Process("free");
        $process->run();
        $error = $process->getErrorOutput();
        $output = $process->getOutput();

        $memInfo = '';
        if (!empty($error)) {
            $memInfo = $error;
        }else if (preg_match("/Mem\s*:\s*(\d*)\s*(\d*)/i", $output, $match)) {
            $total =round( $match[1]/1024);
            $used = round($match[2]/1024);
            $pecent = round( $used/$total * 100).'%' ;
            $memInfo = sprintf('%s/%s MB（%s）',$used,$total,$pecent);
        } else {
            $memInfo = '无法获取';
        }

        $result = [
            'rtnCode' => 0, //-1为失败
            'cpu' => $cpuInfo,
            'memory' => $memInfo,
            'disk' => ""
        ];
        $this->exportJson($result);
    }

    public function actionGetCrontab()
    {
        $crontab = new Crontab();
        $job = $crontab->getJobs();
        $this->exportJson($job);
    }


    public function actionGetScripts()
    {
        $dir=\Yii::$app->basePath."\cron_scripts";
        $files=scandir($dir);
        $result = [];
        foreach($files as $file){
            if($file=="." || $file=='..'){
                continue;
            }
            //filesize($dir.$file);
            $result[]=$file;
        }
        $this->exportJson($result);

    }

    public function actionGetScriptContent($fileName)
    {
        $dir=\Yii::$app->basePath."\cron_scripts";
        $fullName = $dir.'\\'.$fileName;
        $content = file_get_contents($fullName);
        $this->exportJson($content);
    }

    public function actionAddJob($guid='',$minute='*',$hour='*',$day='*',$month='*',$week='*',$command='',$scriptfile='')
    {
        if(empty($guid)){
            $guid = \app\common\support\StringHelper::uuid();
        }
        $dirInfo=\Yii::$app->basePath."/cron_scripts/";
        if(!empty($scriptfile)){
            $command = '/bin/bash '.$dirInfo.$scriptfile;
        }
        $dirInfo=\Yii::$app->basePath."/cron_logs/info/".$guid;
        $dirError=\Yii::$app->basePath."/cron_logs/error/".$guid;
        $cmdTemplate = '* . /etc/profile;echo 开始时间：;/bin/date;%s;echo 结束时间：;/bin/date;1>%s.log 2>%s.log';
        $command = sprintf($cmdTemplate,$command,$dirInfo,$dirError);

        $job = new Job();
        $job
            ->setMinute($minute)
            ->setHour($hour)
            ->setDayOfMonth($day)
            ->setMonth($month)
            ->setDayOfWeek($week)
            ->setCommand($command)
        ;

        $crontab = new Crontab();
        $crontab->addJob($job);
        $handler = $crontab->write();
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