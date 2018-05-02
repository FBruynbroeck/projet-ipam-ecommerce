<?php
require 'models/item.php';
require 'models/book_item.php';
session_start();
$best = BookItem::getBest();
$items = Item::get();
include 'views/welcome.php';
?>
