<?php

namespace app\common\service;

use Yii;

/**
 * 邮件发送服务
 *
 * @author yuzy
 */
class MailService {
    
    /**
     * 队列服务器cpu、内存指标异常是发送警告邮件
     * @return boolean
     */
    public static function sendHWMonitorMail($toMail,$fromMail,$cpuPercent,$memoryPercent)
    {
        $params=[
            'cpu_percent'=>$cpuPercent,
            'memory_percent'=>$memoryPercent,
        ];
        $mail= Yii::$app->mailer->compose()
        ->setTo($toMail)
            ->setFrom($fromMail)
        ->setSubject("明源云客队列服务器异常警告")
        ->setTextBody(sprintf('队列服务器异常，请及时处理。CPU：%s，内存：%s',$cpuPercent.'%',$memoryPercent.'%'));
       return $mail->send();
    }  
}
