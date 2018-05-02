<?php
ob_start();
?>
<div id="accordion">
<?php foreach($books as $book){
    include 'views/includes/card_book.php';
}?>
</div>
<?php
$title = 'Liste des commandes';
$content = ob_get_clean();
include 'views/includes/layout.php';
?>
