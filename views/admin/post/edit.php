<?php
$post = $params['post'];
$tags = $params['tags'];
$nbTags = count($tags);
$postTags = $post->getTags();
$nbPostTags = count($postTags);
?>
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
    <div class="form-group">
        <label for="tags">Tags de l'article</label>
        <select class="form-select" id="tags" name="tags[]" multiple aria-label="multiple select example">
            <?php for ($i = 0; $i < $nbTags; ++$i) : ?>
                <?php $tag = $tags[$i] ?>
                <option value="<?= $tag->id ?>"
                    <?php for ($j = 0; $j < $nbPostTags; ++$j) { echo ($tag->id === $postTags[$j]->id) ? 'selected' : ''; } ?>
                ><?= $tag->name ?></option>
            <?php endfor ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>