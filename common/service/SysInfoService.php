<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/1
 * Time: 22:03
 */

namespace app\common\service;

use Symfony\Component\Process\Process;

class SysInfoService
{
    public function GetSysInfo()
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
            'rtnCode' => 0, //-1失败
            'cpu' => $cpuInfo,
            'memory' => $memInfo,
            'disk' => ""
        ];
        return $result;
    }
}