<h1>Administration des articles</h1>

<?php if ($_GET['success']) : ?>
    <div class="alert alert-success">Vous êtes connecté</div>
<?php endif ?>

<a href="/admin/posts/create" class="btn btn-success my-3">Créer un nouvel article</a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Publié le</th>
            <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <?php $nbPosts = count($posts = $params['posts']) ?>
        <?php for ($i = 0; $i < $nbPosts; ++$i) : ?>
            <?php $post = $posts[$i] ?>
            <tr>
                <th scope="row"><?= $post->id ?></th>
                <td><?= $post->title ?></td>
                <td><?= $post->getCreatedAt() ?></td>
                <td>
                    <a href="/admin/posts/edit/<?= $post->id ?>" class="btn btn-warning">Modifier</a>
                    <form action="/admin/posts/delete/<?= $post->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endfor ?>
    </tbody>
</table>