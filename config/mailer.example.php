<?php

return [
    'class' => 'zyx\phpmailer\Mailer',
    'viewPath' => '@app/mail',
    'useFileTransport' => \YII_DEBUG, // change false to real sending email
    'config' => [
        'mailer' => 'smpt',
        'host' => 'smpt.lapan.co.id',
        'port' => '587',
        'smtpsecure' => 'ssl',
        'smtpauth' => true,
        'username' => 'dpp@lapan.co.id',
        'password' => '@lapan2018',
    ],
];
