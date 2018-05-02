<?php
require 'models/item.php';
session_start();
if(empty($_SESSION['role']) or $_SESSION['role'] != 'Admin'){
    header('Location: /index');
    exit();
}

if(!empty($_POST['id']))
{
    $item = Item::get(array('id' => $_POST['id']));
    $item->title = $_POST['title'];
    $item->price = $_POST['price'];
    $item->save();
    header('Location: /admin/items');
    exit();
}
?>
