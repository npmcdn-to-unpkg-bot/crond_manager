<?php

return [
    'adminEmail' => 'admin@example.com',
    'debug'=>false,
    'hdmonitor_emailto'=>'yuzy@mysoft.com.cn',
    'hdmonitor_emailfrom'=>'admin@mysoft.com.cn',
    'hdmonitor_cpu_max'=>90,
    'hdmonitor_memory_max'=>99,
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.exmail.qq.com',
                'username' => 'yunkeadmin@mysoft.com.cn',
                'password' => 'Myscrm123456',
                'port' => 465,
                'encryption' => 'ssl',
            ],
        ],
    ],
];
