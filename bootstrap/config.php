<?php

// try to load the env file
if (file_exists(__DIR__ . '/../.env')) {
    $env = [];

    $filePath = __DIR__ . '/../.env';
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($lines as $line) {
        // Ignore comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Split the line into key and value
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        // Categorize the settings based on the prefix
        if (strpos($key, 'db_') === 0) {
            $env['database'][substr($key, 3)] = $value; // Remove 'DB_' prefix
        } elseif (strpos($key, 'app_') === 0) {
            $env['app'][substr($key, 4)] = $value; // Remove 'APP_' prefix
        } elseif (strpos($key, 'mail_') === 0) {
            $env['mailer'][substr($key, 5)] = $value; // Remove 'MAIL_' prefix
        }
    }
    return $env;
} else{

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
        'debug' => true,
    ],
    'mailer' => [
        'mail_mailer'=>'smtp',
        'mail_host'=>'sandbox.smtp.mailtrap.io',
        'mail_port'=>'2525',
        'mail_username'=>'8c5f52efef456e',
        'mail_password'=>'3fbe8d1e9965b9',
    ]
];
}
