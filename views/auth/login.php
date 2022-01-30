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