<?php ob_start() ?>
<h2>Les meilleures ventes</h2>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php foreach($best as $item):?>
    <div class="carousel-item <?php if($item === reset($best)) echo 'active'?>">
        <div class="justify-content-center card-columns">
            <?php $item = $item->item?>
            <?php include 'includes/card_item.php';?>
        </div>
    </div>
    <?php endforeach;?>
  </div>
</div>
<h2>Les articles</h2>
<div class="card-columns">
    <?php foreach($items as $item):?>
        <?php include 'includes/card_item.php';?>
    <?php endforeach;?>
</div>
<?php
$title = 'Accueil';
$content = ob_get_clean();
include 'includes/layout.php';
?>
