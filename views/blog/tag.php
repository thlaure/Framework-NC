<?php $tag = $params['tag'] ?>
<h1><?= $tag->name ?></h1>

<?php $nbPosts = count($posts = $tag->getPosts()) ?>
<?php for ($i = 0; $i < $nbPosts; ++$i) : ?>
    <?php $post = $posts[$i] ?>
    <div class="card mb-3">
        <div class="card-body">
            <a href="/posts/<?= $post->id ?>"><?= $post->title ?></a>
        </div>
    </div>
<?php endfor ?>