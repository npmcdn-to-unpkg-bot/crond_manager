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

class SysInfoService
{
    public function GetSysInfo()
    {
        $cpu = $this->GetCpuInfo();
        if(array_key_exists('error',$cpu)){
            $cpuInfo = $cpu['error'];
        }
        else{
            $cpuInfo = $cpu['cpu-model'];
        }
        $memory = $this->GetMemoryInfo();
        if(array_key_exists('error',$memory)){
            $memoryInfo = $memory['error'];
        }
        else{
            $memoryInfo = $cpu['info'];
        }
        $result = [
            'rtnCode' => 0, //-1失败
            'cpu' => $cpuInfo,
            'memory' => $memoryInfo,
            'disk' => ""
        ];
        return $result;
    }

    public function SamplingSysinfo(){
        $cpu = $this->GetCpuInfo();
        $memory = $this->GetMemoryInfo();
        $logService = new CrondServerPerfLogService();
        $logService->addLog(1,$cpu['cpu-percent'],$memory['percent']);
    }

    public function GetCpuInfo(){
        $process = new Process("more /proc/cpuinfo |grep -i model");
        $process->run();
        $error = $process->getErrorOutput();
        $output = $process->getOutput();

        $cpuModel = '';
        $errorInfo = '';
        if (!empty($error)) {
            $errorInfo = $error;
        }else if (preg_match("/model name\s*:\s*(.*)/i", $output, $match)) {
            $cpuModel = $match[1];
        } else {
            $errorInfo = '无法获取cpu model';
        }

        $process = new Process("top -n 1 |grep Cpu");
        $process->run();
        $error = $process->getErrorOutput();
        $output = $process->getOutput();

        $cpuPercent = 0;
        if (!empty($error)) {
            $errorInfo = $errorInfo.PHP_EOL.$error;
        }else if (preg_match("/.*:\s*([\d\.]*)%us,\s*([\d\.]*)%sy,\s*([\d\.]*)%ni,\s*([\d\.]*)%id,/i", $output, $match)) {
            $user = $match[1];
            $system = $match[2];
            $nice = $match[3];
            $idle = $match[4];
            $cpuPercent = round( 100*($user+$nice+$system)/($user + $nice+ $system + $idle),2);
        } else {
            $errorInfo = $errorInfo.PHP_EOL.'无法获取cpu usage percent';
        }

        return [
            'cpu-model'=>$cpuModel,
            'cpu-percent' =>$cpuPercent,
            'error'=>$errorInfo,
        ];
    }

    public function GetMemoryInfo(){
        $process = new Process("free");
        $process->run();
        $error = $process->getErrorOutput();
        $output = $process->getOutput();

        $total =null;
        $used = null;
        $pecent = null ;
        $memInfo = null;
        if (!empty($error)) {
            $memInfo = $error;
        }else if (preg_match("/Mem\s*:\s*(\d*)\s*(\d*)/i", $output, $match)) {
            $total =ceil( $match[1]/1024/1024);
            $used = round($match[2]/1024/1024,2);
            $pecent = round( $used/$total * 100) ;
            $memInfo = sprintf('%s/%s GB（%s）',$used,$total,$pecent.'%');
        } else {
            $memInfo = '无法获取';
        }

        return [
            'total'=>$total,
            'used'=>$used,
            'percent'=>$pecent,
            'info'=>$memInfo
        ];
    }
}