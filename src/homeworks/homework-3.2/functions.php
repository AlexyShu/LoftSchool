<?php

function getUserByEmail(string $userMail, \PDO $pdo): array {
    $query = $pdo->prepare("select * from users where email = '$userMail'");
    $query->execute();
    return $query->fetchAll(\PDO::FETCH_ASSOC);
}

function createUser(string $userMail, string $name, \PDO $pdo): void {
    $query = $pdo->prepare("insert into users (name, order_count, email) values ('$name', 1, '$userMail')"); 
    $query->execute();
}

function incOrders(int $userId, \PDO $pdo) {
    $query = $pdo->prepare("update users set order_count = order_count+1 where id = $userId");
    $query->execute();
}

function showResult(string $address, int $orderId, int $orderCount) {
    echo "<div>" . PHP_EOL;
    echo "<p>" . "Спасибо, ваш заказ будет доставлен по адресу: " . $address . "</p>" . PHP_EOL;PHP_EOL;
    echo "<p>" . "Номер вашего заказа: " . $orderId . "</p>" . PHP_EOL;PHP_EOL;
    echo "<p>" . "Это ваш " .  $orderCount .  "-й заказ!" . "</p>" . PHP_EOL;PHP_EOL;
    echo "</div>" . PHP_EOL;
}
function createOrder(int $userId, string $userAddress, \PDO $pdo): array {
    $query = $pdo->prepare("insert into orders (user_id, address, created_at) values ($userId, '$userAddress', CURDATE())");
    $query->execute();
    return $query->fetchAll(\PDO::FETCH_ASSOC);
}

function getOrderId(int $userId,  \PDO $pdo): array {
    $query = $pdo->prepare("select * from orders where user_id = $userId order by id desc limit 1");
    $query->execute();
    return $query->fetchAll(\PDO::FETCH_ASSOC);
}