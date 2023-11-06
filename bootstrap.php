<?php

define('BASE_URL_PATH', '/');

require_once __DIR__ . '/src/library.php';
require_once __DIR__ . '/vendor/Psr4AutoloaderClass.php';
$loader = new Psr4AutoloaderClass;
$loader->register();


$loader->addNamespace('CT275\Labs', __DIR__ .'/src');

try {
    $PDO = (new CT275\Labs\PDOFactory)->create([
    'dbhost' => 'localhost',
    'dbname' => 'ct275_phoneha',
    'dbuser' => 'root',
    'dbpass' => ''
    ]);
    } catch (Exception $ex) {
    echo 'Không thể kết nối đến MySQL,
    kiểm tra lại username/password đến MySQL.<br>';
    exit("<pre>${ex}</pre>");
    }