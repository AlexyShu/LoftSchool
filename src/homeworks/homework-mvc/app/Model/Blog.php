<?php
namespace App\Model;

use Base\DB;

class Blog
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    function createBlog(string $text, string $image): void {
        $query = "insert into messages (text, user_id, created_at, image) values (:text, :user_id, CURDATE())";
        $prepared = $this->db->getDB()->prepare($query);
        $prepared->execute([
            'text' => $text,
            'user_id' => $_SESSION['id'],
        ]);
    }

    function getLatestTwentyMessages():array
    {
        $query = "select * from messages order by id desc limit 20";
        $prepared = $this->db->getDB()->prepare($query);
        $prepared->execute();
        return $prepared->fetchAll(\PDO::FETCH_ASSOC);
    }
}