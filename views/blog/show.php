<?php
$post = $params['post'];
$nbTags = count($tags = $post->getTags());
?>
<h1><?= $post->title ?></h1>
<div>
    <?php for ($i = 0; $i < $nbTags; ++$i) : ?>
        <span><?= $tags[$i]->name ?></span>
    <?php endfor ?>
</div>
<p><?= $post->content ?></p>
<a href="/posts" class="btn btn-secondary">Retour en arrière</a>