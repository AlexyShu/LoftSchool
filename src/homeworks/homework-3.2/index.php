<?php
require_once('functions.php');

//task 2

// 1. **[Скачайте](https://drive.google.com/file/d/1mrOJkfsk4lIwV-xSfSpqfRpMgeFXEMj-/view?usp=sharing)** верстку сайта **“Бургерная”**
// 2. Внизу вы найдете форму заказа, напишите **скрипт**, обрабатывающий эту форму. **Скрипт должен:**
// - Проверить, существует ли уже пользователь с таким email, если нет - создать его, если да - увеличить число заказов по этому email. Двух пользователей с одинаковым email быть не может.
// - Сохранить данные заказа - id пользователя, сделавшего заказ, дату заказа, полный адрес клиента.
// - Скрипт должен вывести пользователю:

// ```jsx
// Спасибо, ваш заказ будет доставлен по адресу: “тут адрес клиента”
// Номер вашего заказа: #ID
// Это ваш n-й заказ!
// ```

// Где **ID** - уникальный идентификатор только что созданного заказа **n** - общий кол-во заказов, который сделал пользователь с этим email включая текущий
// **Оформление не требуется, достаточно текста на белом фоне, отбитого переходами строк.**
// *В задании необходимо использовать базы данных. Дамп БД необходимо приложить к репозиторию.*

$pdo = new \PDO('mysql:host=mysql;dbname=loftschool', 'loftschool', 'secret');

$pdo->exec('create table if not exists `users` (id int not null primary key auto_increment, name varchar(250) not null, order_count int, email varchar(250) not null)');
$pdo->exec('create table if not exists `orders` (id int not null primary key auto_increment, user_id int not null, address varchar(250), created_at date)');

$email = $_POST['email'];
$name = $_POST['name'];
$street = $_POST['street'];
$home = $_POST['home'];
$part = $_POST['part'];
$appt = $_POST['appt'];
$floor = $_POST['floor'];

$user =  getUserByEmail($email, $pdo);

$address = $street . ", " . $home . ", " . $part . ", " . $appt . ", " . $floor;

if($user) {
    $userId = $user[0]['id'];
    incOrders($userId, $pdo);
    createOrder($userId, $address, $pdo);
    $order = getOrderId($userId, $pdo);
    showResult($address, $order[0]['id'], $user[0]['order_count']);
} else {
    createUser($email, $name, $pdo);
    $newUser = getUserByEmail($email, $pdo);
    createOrder($newUser[0]['id'], $address, $pdo);
    $order = getOrderId($newUser[0]['id'], $pdo);
    showResult($address, $order[0]['id'], $newUser[0]['order_count']);
}








