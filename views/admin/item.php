<?php
ob_start();
?>
<div class="container">
    <form method="post" action="<?=$action?>">
        <?php if(isset($item)):?>
        <input type="hidden" name="id" value=<?=$item->id?>>
        <?php endif?>
        <div class="form-group">
            <label for="title">Titre de l'article</label>
            <input type="text" class="form-control" id="title" name="title" value=<?php if(isset($item)) { echo $item->title; }?>>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" min="0" step="any" class="form-control" id="price" name="price" value=<?php if(isset($item)) { echo $item->price; }?>>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<?php
$content = ob_get_clean();
include 'views/includes/layout.php';
?>
