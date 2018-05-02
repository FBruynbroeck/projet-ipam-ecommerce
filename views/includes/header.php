<div class="fixed-top">
<header class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/index">Mon projet</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($title =='Accueil'){echo 'active';}?>">
                <a class="nav-link" href="/index">Accueil <span class="sr-only">(current)</span></a>
            </li>
            <?php if(!empty($_SESSION['login'])):?>
            <li class="nav-item <?php if($title =='Liste de mes commandes'){echo 'active';}?>">
                <a class="nav-link" href="/customer/books">Liste de mes commandes <span class="sr-only">(current)</span></a>
            </li>
            <?php endif?>
            <li class="nav-item <?php if($title =='A propos'){echo 'active';}?>">
                <a class="nav-link" href="/about">A propos</a>
            </li>
            <?php if(!empty($_SESSION['role']) and $_SESSION['role'] === 'Admin'){include 'views/admin/admin_menu.php';}?>
        </ul>
        <a href="/mycart" class="btn btn-primary">
          Mon panier <span id="total_items" class="badge badge-light"/>
        </a>
        <?php if(empty($_SESSION['login'])):?>
            <a class="btn btn-outline-success" href="/login">S'identifier</a>
        <?php else: ?>
            <div class="btn btn-secondary">Salut <?=$_SESSION['login']?></div>
            <a class="btn btn-outline-success" href="/logout">Se déconnecter</a>
        <?php endif?>
    </div>
</header>
<div id="info" class="alert alert-info alert-dismissible fade text-center" role="alert">
    <br>
</div>
</div>
