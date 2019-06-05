<?php

date_default_timezone_set('Europe/Belgrade');

return [
    'db_dsn' => 'mysql:host=localhost;dbname=insurance',
    'db_user' => 'root',
    'db_pass' => '',
    'db_options' => [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
];
