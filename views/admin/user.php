<?php
ob_start();
?>
<div class="container">
    <form method="post" action="<?=$action?>">
        <?php if(isset($user)):?>
        <input type="hidden" name="id" value=<?=$user->id?>>
        <?php endif?>
        <div class="form-group">
            <label for="login">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="login" name="login" value=<?php if(isset($user)) { echo $user->login; }?>>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" >
        </div>
        <div class="form-group">
            <label for="passwordconfirm">Confirmation du mot de passe</label>
            <input type="password" class="form-control" id="passwordconfirm" name="passwordconfirm" placeholder="Confirmation du mot de passe" >
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<?php
$content = ob_get_clean();
include 'views/includes/layout.php';
?>
