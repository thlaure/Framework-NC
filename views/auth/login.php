<?php if (isset($_SESSION['errors'])) : ?>

    <?php $nbErrorsSession = count($errorsSession = $_SESSION['errors']) ?>
    <?php for ($i = 0; $i < $nbErrorsSession; ++$i) : ?>
        <?php $errorsArray = $errorsSession[$i] ?>
        <?php foreach ($errorsArray as $errors) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>
    <?php endfor ?>
<?php endif ?>
<?php session_destroy() ?>

<h1>Se connecter</h1>

<form action="/login" method="POST">
    <div class="form-group">
        <label for="username">Nom de l'utilisateur</label>
        <input type="text" id="username" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>