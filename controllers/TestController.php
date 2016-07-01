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

class TestController
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
            ->setCommand('myAmazingCommandToRunPeriodically')
        ;

        $crontab = new Crontab();
        $crontab->addJob($job);
        $crontab->render();
    }
}