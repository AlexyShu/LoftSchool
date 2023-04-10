<?php
include '../../../vendor/autoload.php';
include '../base/config.php';

use Base\Aplication;

$app = new Aplication();
$app->run();


$app = new Aplication();
$app->run();


//use Base\DB;
//
//$db = new DB();
//$db->createUserTable();
//$db->createMessagesTable();

//$pdo = new \PDO('mysql:host=mysql;dbname=loftschool', 'loftschool', 'secret');
//
//$pdo->exec('drop table users');

//$user = $modelUser->getUser('test@test.ru', $pdo);
//var_dump($user);