<?php
include '../../../vendor/autoload.php';
include '../base/config.php';

use Base\Aplication;
use Base\DB;

$db = new DB();
$db->createUserTable();
$db->createMessagesTable();
$app = new Aplication();
$app->run();

//$pdo = new \PDO('mysql:host=mysql;dbname=loftschool', 'loftschool', 'secret');
//
//$pdo->exec('drop table users');

//$user = $modelUser->getUser('test@test.ru', $pdo);
//var_dump($user);