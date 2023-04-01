<?php
namespace Base;

class DB
{
    public $db;
    public function __construct()
    {
        $this->db = new \PDO('mysql:host=mysql;dbname=loftschool', 'loftschool', 'secret');
    }

    public function getDB(): \PDO
    {
        return $this->db;
    }

    public function createUserTable():void
    {
        $this->db->exec('create table if not exists `users` (id int not null primary key auto_increment, name varchar(250) not null, email varchar(250) not null unique, password varchar(250) not null, created_at date not null, is_admin boolean not null)');
    }

    public function createMessagesTable():void
    {
        $this->db->exec('create table if not exists `messages` (id int not null primary key auto_increment, text varchar(250) not null, user_id int not null, created_at date not null, image varchar(250))');
    }

}