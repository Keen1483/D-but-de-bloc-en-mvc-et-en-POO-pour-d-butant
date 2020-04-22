<h3>modifier le commentaire</h3>
<form action="index.php?action=updateComment" method="POST">
    <div>
        <label for="commentUpdate">Votre modification</label><br>
        <textarea name="commentUpdate" id="commentUpdate" cols="30" rows="10"></textarea>
        <input type="hidden" name="idComment" value="<?= $idComment ?>">
        <input type="hidden" name="postId" value="<?= $postId ?>">
    </div>
    <div>
        <input type="submit">
    </div>
</form>