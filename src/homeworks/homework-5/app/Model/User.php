<?php
namespace App\Model;

class User
{
    function createUser(string $name, string $email, string $password,  \PDO $db): void {
        $query = "insert into users (name, email, password, created_at) values (:name, :email, :password, CURDATE())";
        $prepared = $db->prepare($query);
        $prepared->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }

    function getUser(string $email, \PDO $db): array
    {
        $query = "select * from users where email = :email";
        $prepared = $db->prepare($query);
        $prepared->execute([
            'email' => $email,
        ]);
        return $prepared->fetchAll(\PDO::FETCH_ASSOC);
    }

}