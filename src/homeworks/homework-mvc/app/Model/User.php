<?php
namespace App\Model;

use Base\DB;

class User
{
    const GENDER_FEMALE = 2;
    const GENDER_MALE = 1;

    private $id;
    private $name;
    private $password;
    private $createdAt;
    private $gender;

    public function __construct($data = [])
    {
        if ($data) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->password = $data['password'];
            $this->gender = $data['gender'];
            $this->createdAt = $data['created_at'];
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender(): int
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getGenderString(): string
    {
        return $this->gender == self::GENDER_MALE ? 'male' : 'female';
    }

    /**
     * @param mixed $gender
     */
    public function setGender(int $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function save()
    {
        $db = Db::getInstance();
        $insert = "INSERT INTO users (`name`, `password`, `gender`) VALUES (
            :name, :password, :gender
        )";
        $db->exec($insert, __METHOD__, [
            ':name' => $this->name,
            ':password' => $this->password,
            ':gender' => $this->getGender()
        ]);

        $id = $db->lastInsertId();
        $this->id = $id;

        return $id;
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE id = $id";
        $data = $db->fetchOne($select, __METHOD__);

        if (!$data) {
            return null;
        }

        return new self($data);
    }

    public static function getByName(string $name): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE `name` = :name";
        $data = $db->fetchOne($select, __METHOD__, [
            ':name' => $name
        ]);

        if (!$data) {
            return null;
        }

        return new self($data);
    }

    public static function getPasswordHash(string $password)
    {
        return sha1(',.lskfjl' . $password);
    }

}

//class User
//{
//    private $db;
//
//    public function __construct()
//    {
//        $this->db = new DB();
//    }
//
//    function createUser(string $name, string $email, string $password): void {
//        $query = "insert into users (name, email, password, created_at, is_admin) values (:name, :email, :password, CURDATE(), false)";
//        $prepared = $this->db->getDB()->prepare($query);
//        $prepared->execute([
//            'name' => $name,
//            'email' => $email,
//            'password' => $password,
//        ]);
//    }
//
//    function getPasswordHash(string $password): string
//    {
//        return sha1('bla,bla.bla' . $password);
//    }
//
//    function getUser(string $email, string $password): array
//    {
//        $query = "select * from users where email = :email and password = :password";
//        $prepared = $this->db->getDB()->prepare($query);
//        $prepared->execute([
//            'email' => $email,
//            'password' => sha1('bla,bla.bla' . $password),
//        ]);
//        return $prepared->fetchAll(\PDO::FETCH_ASSOC);
//    }
//
//    function getUserById(int $id): array
//    {
//        $query = "select * from users where id = :id";
//        $prepared = $this->db->getDB()->prepare($query);
//        $prepared->execute([
//            'id' => $id,
//        ]);
//        return $prepared->fetchAll(\PDO::FETCH_ASSOC);
//    }
//
//}