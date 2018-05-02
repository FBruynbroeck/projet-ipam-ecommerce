<?php
ob_start();
?>
<div class="container">
    <h2>Prix</h2>
    <div><?=$item->price ?> €</div>
</div>
<button class="btn btn-info add_cart" id="<?= $item->id?>">Ajouter au panier</button>
<?php
$title = $item->title;
$content = ob_get_clean();
include 'views/includes/layout.php';
?>
