<?php
$post = isset($params['post']) ? $params['post'] : null;
$tags = isset($params['tags']) ? $params['tags'] : null;
$nbTags = isset($tags) ? count($tags) : null;
$postTags = isset($post) ? $post->getTags() : null;
$nbPostTags = isset($postTags) ? count($postTags) : null;
?>
<h1><?= $post->title ?? 'Créer un nouvel article' ?></h1>

<form action=<?= isset($post) ? "/admin/posts/edit/{$post->id}" : "/admin/posts/create" ?> method="POST">
    <div class="form-group">
        <label for="title">Titre de l'article</label>
        <input type="text" id="title" class="form-control" name="title" value="<?= $post->title ?? '' ?>">
    </div>
    <div class="form-group">
        <label for="content">Contenu de l'article</label>
        <textarea class="form-control" name="content" id="content" rows="10"><?= $post->content ?? '' ?></textarea>
    </div>
    <div class="form-group">
        <label for="tags">Tags de l'article</label>
        <select class="form-select" id="tags" name="tags[]" multiple aria-label="multiple select example">
            <?php for ($i = 0; $i < $nbTags; ++$i) : ?>
                <?php $tag = $tags[$i] ?>
                <option value="<?= $tag->id ?>"
                    <?php if (isset($post)) : ?>
                        <?php for ($j = 0; $j < $nbPostTags; ++$j) { echo ($tag->id === $postTags[$j]->id) ? 'selected' : ''; } ?>
                    <?php endif ?>
                ><?= $tag->name ?></option>
            <?php endfor ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><?= isset($post) ? 'Enregistrer les modifications' : 'Enregistrer un article' ?></button>
</form>