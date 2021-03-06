<?php
namespace Keen\Blog;

require_once 'model/Manager.php';

class PostManager extends Manager
{
    public function getPostS()
    {
        $db = $this->dbConnect();
        $req = $db->query(
            'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%ss\') AS creation_date_fr
            FROM posts
            ORDER BY creation_date DESC
            LIMIT 0, 5'
        ) or die(print_r($db->errorInfo()));;

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(
            'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%ss\') AS creation_date_fr
            FROM posts
            WHERE id = ?'
        ) or die(print_r($db->errorInfo()));;
        $req->execute([$postId]);
        $post = $req->fetch();

        return $post;
    }
}