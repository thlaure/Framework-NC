<h1>Les derniers articles</h1>

<?php $nbPosts = count($posts = $params['posts']) ?>
<?php for ($i = 0; $i < $nbPosts; ++$i) : ?>
    <?php $post = $posts[$i] ?>
    <div class="card mb-3">
        <div class="card-body">
            <h2><?= $post->title ?></h2>
            <small>Publié le <?= $post->getCreatedAt() ?></small>
            <p><?= $post->getExcerpt() ?></p>
            <?= $post->getButton() ?>
        </div>
    </div>
<?php endfor ?>