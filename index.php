<?php
require 'controller/frontend.php';

try {
    if(isset($_GET['action']))
    {
        if($_GET['action'] == 'listPosts')
        {
            listPosts();
        }
        elseif($_GET['action'] == 'post')
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                post();
            } else {
                throw new Exception('aucun identifiant de billet n\'a été envoyé');
            }
        } elseif($_GET['action'] == 'addComment') {
            if(isset($_GET['id']) && $_GET['id'] > 0) {
                if(!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('tous les champs ne sont pas remplis !'); 
                }
            } else {
                throw new Exception('aucun identifiant de billet envoyé');
            }
        } elseif($_GET['action'] == 'updateComment') {
            if(isset($_GET['id']) && isset($_GET['postId'])) {
                updateComment($_GET['id'], $_GET['postId']);
            } elseif(isset($_POST['commentUpdate']) && isset($_POST['idComment']) && isset($_POST['postId'])) {
                if($_POST['idComment'] > 0 && $_POST['postId'] > 0) {
                    toComment($_POST['commentUpdate'], $_POST['idComment'], $_POST['postId']);
                } else {
                    throw new Exception('aucun identifiant du commentaire envoyé');
                }
            } else {
                throw new Exception("Error Processing Request");
            }
        }
    } else {
        listPosts();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require 'view/errorView.php';
}