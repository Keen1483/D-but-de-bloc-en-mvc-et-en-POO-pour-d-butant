<?php
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';

/*
spl_autoload_register(function ($class) {
    require_once 'model/'.$class.'.php';
});*/

function listPosts()
{
    $postManager = new \Keen\Blog\PostManager;
    $posts = $postManager->getPostS();

    require 'view/frontend/listPostsView.php';
}

function post()
{
    $postManager = new \Keen\Blog\PostManager;
    $commentManager = new \Keen\Blog\CommentManager;
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require 'view/frontend/postView.php';
}

function addComment($postId, $author, $comment)
{
    $commentManager = new \Keen\Blog\CommentManager;
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function updateComment($id, $post_Id)
{
    $idComment = $id;
    $postId = $post_Id;
    require 'view/frontend/updateComment.php';
}

function toComment($comment, $id, $postId)
{
    $commentManager = new \Keen\Blog\CommentManager;
    $updatedLines = $commentManager->postUpdateComment($comment, $id);
    var_dump($updatedLines);

    if($updatedLines === false) {
        throw new Exception('Impossible de modifier ce commentaire'); 
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}