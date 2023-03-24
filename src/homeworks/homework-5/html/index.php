<?php
include '../../../vendor/autoload.php';

use App\Model\User;
use Base\Aplication;

$app = new Aplication();
$app->run();

$modelUser = new User();


//$pdo = new \PDO('mysql:host=mysql;dbname=loftschool', 'loftschool', 'secret');
//$pdo->exec('create table if not exists `users` (id int not null primary key auto_increment, name varchar(250) not null, email varchar(250) not null, password varchar(250), created_at date)');

//$modelUser->createUser('Test', 'test1@test.ru', 'secret',  $pdo);
//$user = $modelUser->getUser('test@test.ru', $pdo);
//var_dump($user);