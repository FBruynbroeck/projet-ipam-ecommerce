<?php
require 'models/item.php';
session_start();
if(empty($_SESSION['role']) or $_SESSION['role'] != 'Admin'){
    header('Location: /index');
    exit();
}

if(!empty($_GET['id']))
{
    $item = Item::get(array('id' => $_GET['id']));
    $title = "Edition de l'article: ".$item->title;
    $action = "/admin/edit_item";
}
else
{
    $title = 'Nouvel article';
    $action = "/admin/new_item";
}
include 'views/admin/item.php';
?>
