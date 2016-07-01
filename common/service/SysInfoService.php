<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/1
 * Time: 22:03
 */

namespace app\common\service;

use app\models\CrondServerPerfLog;
use Symfony\Component\Process\Process;
use yii\log\Logger;

class SysInfoService
{
    public function GetSysInfo()
    {
        $cpu = $this->GetCpuInfo();
        if(!empty($cpu['error'])){
            $cpuInfo = $cpu['error'];
        }
        else{
            $cpuInfo = $cpu['cpu_model'];
        }
        $memory = $this->GetMemoryInfo();
        if(!empty($memory['error'])){
            $memoryInfo = $memory['error'];
        }
        else{
            $memoryInfo = $memory['memory_info'];
        }
        $result = [
            'rtnCode' => 0, //-1失败
            'cpu' => $cpuInfo,
            'memory' => $memoryInfo,
            'disk' => ""
        ];
        return $result;
    }

    public function SamplingAllServer(){
        /**
         * @var $svr CrondServerService
         */
        $serverService = new CrondServerService();
        $logService = new CrondServerPerfLogService();
        $servers = $serverService->getCrondServers();
        foreach($servers as $svrInfo){
            $host = $svrInfo['api_host'];
            $id = $svrInfo['id'];
            $url = $host.'/index.php?r=sysinfo/sample-sys-info';
            try{
                $sysinfo = json_decode($serverService->request_get($url, []));
                $logService->addLog($id,$sysinfo->data->cpu_percent,$sysinfo->data->memory_percent);
            }
            catch(\Exception $ex){
                \Yii::getLogger()->log('服务器性能监控采样失败：'.$ex->getMessage(),Logger::LEVEL_INFO);

            }

        }
    }

    public function SamplingSysinfo(){
        $cpu = $this->GetCpuInfo();
        $memory = $this->GetMemoryInfo();
        return [
            'cpu_percent'=> $cpu['cpu_percent'],
            'memory_percent'=>$memory['memory_percent']
        ];
    }

    public function GetCpuInfo(){
        if(\Yii::$app->params['debug']){
            $output = 'model name	: Intel(R) Xeon(R) CPU E5-2650 v2 @ 2.60GHz';
        }
        else{
            $process = new Process("more /proc/cpuinfo |grep -i model");
            $process->run();
            $error = $process->getErrorOutput();
            $output = $process->getOutput();
        }

        $cpuModel = '';
        $errorInfo = '';
        if (!empty($error)) {
            $errorInfo = $error;
        }else if (preg_match("/model name\s*:\s*(.*)/i", $output, $match)) {
            $cpuModel = $match[1];
        } else {
            $errorInfo = '无法获取cpu model';
        }

        if(\Yii::$app->params['debug']){
            $output = 'Cpu(s):  0.0%us,  0.0%sy,  0.0%ni, 99.8%id,  0.0%wa,  0.0%hi,  0.0%si,  0.1%st';
        }
        else{
            $process = new Process("top -n 1 |grep Cpu");
            $process->run();
            $error = $process->getErrorOutput();
            $output = $process->getOutput();
        }

        $cpuPercent = 0;
        if (!empty($error)) {
            $errorInfo = $errorInfo.PHP_EOL.$error;
        }else if (preg_match("/.*:\s*([\d\.]*)%us,\s*([\d\.]*)%sy,\s*([\d\.]*)%ni,\s*([\d\.]*)%id,/i", $output, $match)) {
            $user = $match[1];
            $system = $match[2];
            $nice = $match[3];
            $idle = $match[4];
            $cpuPercent = round( 100*($user+$nice+$system)/($user + $nice+ $system + $idle),2);
            if($cpuPercent==0){
                $cpuPercent=1;
            }
        } else {
            $errorInfo = $errorInfo.PHP_EOL.'无法获取cpu usage percent';
        }

        return [
            'cpu_model'=>$cpuModel,
            'cpu_percent' =>$cpuPercent,
            'error'=>$errorInfo,
        ];
    }

    public function GetMemoryInfo(){
        if(\Yii::$app->params['debug']){
            $output = 'Mem:       1018508     949396      69112          0      68616     274796';
        }
        else{
            $process = new Process("free");
            $process->run();
            $error = $process->getErrorOutput();
            $output = $process->getOutput();
        }

        $total =null;
        $used = null;
        $pecent = null ;
        $memInfo = null;
        $errorInfo = null;
        if (!empty($error)) {
            $errorInfo = $error;
        }else if (preg_match("/Mem\s*:\s*(\d*)\s*(\d*)/i", $output, $match)) {
            $total =ceil( $match[1]/1024/1024);
            $used = round($match[2]/1024/1024,2);
            $pecent = round( $used/$total * 100) ;
            $memInfo = sprintf('%s/%s GB（%s）',$used,$total,$pecent.'%');
        } else {
            $errorInfo = '无法获取内存信息';
        }

        return [
            'memory_total'=>$total,
            'memory_used'=>$used,
            'memory_percent'=>$pecent,
            'memory_info'=>$memInfo,
            'error'=>$errorInfo,
        ];
    }
}