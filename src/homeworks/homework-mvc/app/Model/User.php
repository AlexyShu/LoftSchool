<?php
namespace App\Model;

use Base\DB;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    function createUser(string $name, string $email, string $password): void {
        $query = "insert into users (name, email, password, created_at, is_admin) values (:name, :email, :password, CURDATE(), false)";
        $prepared = $this->db->getDB()->prepare($query);
        $prepared->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }

    function getPasswordHash(string $password): string
    {
        return sha1('bla,bla.bla' . $password);
    }

    function getUser(string $email, string $password): array
    {
        $query = "select * from users where email = :email and password = :password";
        $prepared = $this->db->getDB()->prepare($query);
        $prepared->execute([
            'email' => $email,
            'password' => sha1('bla,bla.bla' . $password),
        ]);
        return $prepared->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getUserById(int $id): array
    {
        $query = "select * from users where id = :id";
        $prepared = $this->db->getDB()->prepare($query);
        $prepared->execute([
            'id' => $id,
        ]);
        return $prepared->fetchAll(\PDO::FETCH_ASSOC);
    }

}