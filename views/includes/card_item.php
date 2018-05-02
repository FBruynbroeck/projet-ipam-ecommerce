<div class="card bg-light">
    <img class="card-img-top rounded-circle" src="/downloads/missing.png" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title"><?= $item->title ?></h5>
        <p class="card-text">Petite description du produit</p>
        <span class="badge badge-pill badge-info"><?= $item->price ?> €</span>
    </div>
    <div class="card-footer container">
        <div class="row">
            <a href="/item?id=<?= $item->id?>" class="col btn btn-primary">Détail</a>
            <button class="col btn btn-info add_cart" id="<?= $item->id?>">Ajouter au panier</button>
        </div>
    </div>
</div>
