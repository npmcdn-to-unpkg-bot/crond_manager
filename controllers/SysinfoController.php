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

class SysinfoController extends BaseController
{
    public function actionGetSysInfo()
    {
        $sysInfoService = new SysInfoService();
        $result = $sysInfoService->GetSysInfo();
        $this->exportJson($result);
    }

}