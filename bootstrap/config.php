<?php

return [

    'database' => [

        'host' => '127.0.0.1',
        'port' => 3306,
        'dbname' => 'vetcampdb',
        'user' => 'root',
        'pass' => '', // change the password to your own (default is empty)
    ],
    'app' => [

        'name' => 'Vetcamp',
    ],
    'mailer' => [
        'mail_mailer'=>'smtp',
        'mail_host'=>'sandbox.smtp.mailtrap.io',
        'mail_port'=>'2525',
        'mail_username'=>'8c5f52efef456e',
        'mail_password'=>'3fbe8d1e9965b9',
    ]
];
