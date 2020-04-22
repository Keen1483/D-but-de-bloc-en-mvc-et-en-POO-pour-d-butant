<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
while ($comment = $comments->fetch())
{
?>
    <p>
        <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?>
        <a href="index.php?action=updateComment&amp;id=<?= $comment['id'] ?>&amp;postId=<?= $post['id'] ?>">
        (modifier)</a></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
}
?>

<h2>Commentaires</a></h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="POST">
    <div>
        <label for="author">Auteur</label><br>
        <input type="text" name="author" id="author">
    </div>
    <div>
        <label for="comment">Commentaire</label><br>
        <input type="text" name="comment" id="comment">
    </div>
    <div>
        <input type="submit">
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>