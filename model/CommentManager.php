<?php
namespace Keen\Blog;

require_once 'model/Manager.php';

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(
            'SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'/%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr
            FROM comments WHERE post_id = ?'
        ) or die(print_r($db->errorInfo()));;
        $req->execute([$postId]);

        return $req;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare(
            'INSERT INTO comments (post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())'
        ) or die(print_r($db->errorInfo()));
        $affectedLines = $comments->execute([$postId, $author, $comment]);

        return $affectedLines;
    }

    public function postUpdateComment($comment, $id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(
            'UPDATE comments SET comment = :comment, comment_date = NOW() WHERE id = :id'
        ) or die(print_r($db->errorInfo()));
        $updatedLines = $req->execute(['comment' => $comment, 'id' => $id]);

        return $updatedLines;
    }
}