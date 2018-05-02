<?php
require 'models/item.php';
session_start();
if(empty($_SESSION['role']) or $_SESSION['role'] != 'Admin'){
    header('Location: /index');
    exit();
}

if(!empty($_POST['title']) and !empty($_POST['price']))
{
    $user = new Item($_POST);
    $user->save();
    header('Location: /index');
    exit();
}
?>
