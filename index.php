<?php

session_start();

require_once'config/config.php';
require_once'config/database.php';

spl_autoload_register(function($class){
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';

    $len = strlen($prefix);
    if(strncmp($prefix, $class, $len) !== 0){
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if(file_exists($file)){
        require $file;
    }
});

$database = new Database;
$db = $database->getConnection();

$userModel = new App\Models\User($db);
$authController = new \App\Controllers\AuthController($userModel);

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

switch($path){
    case '':
    case 'login':
        $authController->login();
        break;
    case 'register':
        $authController->register();
        break;
    case 'logout':
        $authController->logout();
        break;
}