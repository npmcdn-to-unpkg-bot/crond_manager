<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/1
 * Time: 22:02
 */

namespace app\common\service;


use yii\base\Exception;
use Crontab\Crontab;
use Crontab\Job;

class CronFileService
{
    public function GetCrontab()
    {
        $crontab = new Crontab();
        $jobs = $crontab->getJobs();
        return $jobs;
    }


    public function GetScripts()
    {
        $dir=\Yii::$app->basePath."/cron_scripts";
        $files=scandir($dir);
        $result = [];
        foreach($files as $file){
            if($file=="." || $file=='..'){
                continue;
            }
            //filesize($dir.$file);
            $result[]=$file;
        }
        return $result;

    }

    public function GetScriptContent($fileName)
    {
        $dir=\Yii::$app->basePath."/cron_scripts";
        $fullName = $dir.'/'.$fileName;
        $content = file_get_contents($fullName);
        return $content;
    }

    public function GetJobRecentExcuteSatus($guid)
    {
        $dir=\Yii::$app->basePath."/cron_logs";
        $errorFile = $dir.'/error/'.$guid.'.log';
        $infoFile = $dir.'/info/'.$guid.'.log';

        if(file_exists($errorFile)){
            $erroTime = filectime($errorFile);
        }
        else{
            $erroTime = '';
        }
        if(file_exists($infoFile)){
            $infoTime = filectime($infoFile);
        }
        else{
            $infoTime = '';
        }

        $success = false;
        if($erroTime == '' && $infoTime!='' ){
            $success = true;
        }
        if($erroTime != '' && $infoTime!='' && $erroTime<$infoTime)
        {
            $success = true;
        }

        return [
            'success'=>$success,
            'error_time'=>$erroTime==''?'':date("Y-m-d H:i:s",$erroTime),
            'info_time'=>$infoTime==''?'':date("Y-m-d H:i:s",$infoTime),
        ];
    }

    public function SaveJob($guid='',$minute='*',$hour='*',$day='*',$month='*',$week='*',$command='',$scriptfile='')
    {
        $crontab = new Crontab();
        $jobs = $crontab->getJobs();

        if(empty($guid)){
            $job = new Job();
            $guid = \app\common\support\StringHelper::uuid();
            $job->setGuid($guid);
            $crontab->addJob($job);
        }else{
            if(!array_key_exists($guid,$jobs)){
                throw new \Exception('作业不存在');
            }
            $job = $jobs[$guid];
        }

        $dirInfo=\Yii::$app->basePath."/cron_scripts/";
        if(!empty($scriptfile)){
            $command = '/bin/bash '.$dirInfo.$scriptfile;
        }
        $dirInfo=\Yii::$app->basePath."/cron_logs/info/".$guid;
        $dirError=\Yii::$app->basePath."/cron_logs/error/".$guid;
        $cmdTemplate = ' . /etc/profile;%s 1>>%s.log 2>>%s.log';
        $command = sprintf($cmdTemplate,$command,$dirInfo,$dirError);


        $job->setMinute($minute)
            ->setHour($hour)
            ->setDayOfMonth($day)
            ->setMonth($month)
            ->setDayOfWeek($week)
            ->setCommand($command);
        $handler = $crontab->write();
        return [
            'guid'=>$guid,
            'error'=>$handler->getError(),
            'output'=>$handler->getOutput(),
        ];
    }
}