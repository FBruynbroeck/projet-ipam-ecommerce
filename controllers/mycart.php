<?php
require 'models/item.php';
session_start();
$items = array();
$total_prices = 0;
$total_items = 0;
foreach($_SESSION['cart'] as $id => $value){
    $item = Item::get(array('id' => $id));
    $item->quantity = $value['quantity'];
    $total_prices += $item->total();
    $total_items += $item->quantity;
    array_push($items, $item);
}
include 'views/mycart.php';
?>
