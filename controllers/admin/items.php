<?php
require 'models/item.php';
session_start();
if(empty($_SESSION['role']) or $_SESSION['role'] != 'Admin'){
    header('Location: /index');
    exit();
}
$items = Item::get();
include 'views/admin/items.php';
?>
