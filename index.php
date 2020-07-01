<?php
require_once "vendor/autoload.php";

//Загружаем базу данных
$dbConfig = require "src/config/db.php";
$params = require "src/config/params.php";

//Подключаем библиотеку
$db = new \Medoo\Medoo($dbConfig);

//Запускаем приложение
session_start();
\beejee\Application::init($db, $params);
try {
    \beejee\Application::instance()->run();
} catch (Throwable $e) {
    $errorController = new \beejee\controller\Error();
    $errorController->show($e);
}