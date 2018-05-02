<?php ob_start() ?>
<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="login">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp" placeholder="Entrer votre nom d'utilisateur" >
            <small id="loginHelp" class="form-text text-muted">Ne jamais divulguer votre nom d'utilisateur.</small>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" >
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>
<?php
$title = 'S\'identifier';
$content = ob_get_clean();
include 'includes/layout.php'
?>
