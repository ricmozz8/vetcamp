<?php

// check the environment type

$config_file_path = __DIR__ . '/../.envtype';
$env_path = "";


if (file_exists($config_file_path)) {
    $content = file($config_file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($content as $line) {
        if (strpos($line, '#') === 0) {
            continue;
        }
        $type = trim($line);

        if($type == "development" || $type == "testing" ){
            $env_path = __DIR__ . '/../.env';
        }
        elseif($type == "production" ){
            $env_path = __DIR__ . '/../.env.production';
        }
    }

    
}

// try to load the env file


if (file_exists($env_path)) {
    $env = [];

    $filePath = $env_path;
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
        'service' => 'mysql',
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
