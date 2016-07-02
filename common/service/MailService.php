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
    public static function sendHWMonitorMail($toMail,$cpuPercent,$memoryPercent)
    {
        $params=[
            'cpu_percent'=>$cpuPercent,
            'memory_percent'=>$memoryPercent,
        ];
        $mail= Yii::$app->mailer->compose([
                        'html' => 'hwmonitor-html',
                        'text' => 'hwmonitor-text',
                    ],$params);  
        $mail->setTo($toMail);  
        $mail->setSubject("明源云客队列服务器异常警告");
       return $mail->send();
    }  
}
