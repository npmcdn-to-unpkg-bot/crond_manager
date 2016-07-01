<?php
/**
 * Created by PhpStorm.
 * User: zhenyu
 * Date: 2016/7/1
 * Time: 12:57
 */

namespace app\controllers;

use app\common\service\SysInfoService;
use yii\console\Controller;

class ConsoleController extends Controller
{
    public function actionSampleAllSysInfo()
    {
        $sysInfoService = new SysInfoService();
        $result = $sysInfoService->SamplingAllServer();
        $this->exportJson($result);
    }





}