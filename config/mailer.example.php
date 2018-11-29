<?php

return [
    'class' => 'zyx\phpmailer\Mailer',
    'viewPath' => '@app/mail',
    'useFileTransport' => false, // change false to real sending email
    'config' => [
        'mailer' => 'smtp',
        'host' => 'smtp.lapan.co.id',
        'port' => '587',
        'smtpsecure' => 'ssl',
        'smtpauth' => true,
        'username' => 'dpp@lapan.co.id',
        'password' => '@lapan2018',
    ],
];
