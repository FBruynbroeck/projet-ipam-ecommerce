<?php
ob_start();
?>
<table class="table table-light">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Prix</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item):?>
        <tr>
            <th scope="row"><?=$item->id?></th>
            <td><?=$item->title?></td>
            <td><?=$item->price?> €</td>
            <td>
                <div class="row">
                    <form action="/admin/item">
                        <input type="hidden" name="id" value=<?=$item->id?>>
                        <button class="btn btn-outline-success" type="submit">Editer</button>
                    </form>
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal<?= $item->id?>">
                        Supprimer
                    </button>
                    <?php include 'delete_item_model.php' ?>
                </div>
            </td>

        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php
$title = 'Gestion des articles';
$content = ob_get_clean();
include 'views/includes/layout.php';
?>
