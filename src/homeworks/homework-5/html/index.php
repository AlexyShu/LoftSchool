<?php
include '../../../vendor/autoload.php';

use App\Model\User;

$modelUser = new User();

echo("Hello");


$pdo = new \PDO('mysql:host=mysql;dbname=loftschool', 'loftschool', 'secret');
$pdo->exec('create table if not exists `users` (id int not null primary key auto_increment, name varchar(250) not null, email varchar(250) not null, password varchar(250), created_at date)');


$modelUser->createUser('Sasha', 'test@test.ru', 'secret',  $pdo);
$user = $modelUser->getUser('test@test.ru', $pdo);
var_dump($user);