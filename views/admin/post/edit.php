<?php $post = $params['post'] ?>
<h1>Modifier <?= $post->title ?></h1>

<form action="/admin/posts/edit/<?= $post->id ?>" method="POST">
    <div class="form-group">
        <label for="title">Titre de l'article</label>
        <input type="text" id="title" class="form-control" name="title" value="<?= $post->title ?>">
    </div>
    <div class="form-group">
        <label for="content">Contenu de l'article</label>
        <textarea class="form-control" name="content" id="content" rows="10"><?= $post->content ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>