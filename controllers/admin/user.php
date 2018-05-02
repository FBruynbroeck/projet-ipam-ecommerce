<?php
require 'models/user.php';
session_start();
if(empty($_SESSION['role']) or $_SESSION['role'] != 'Admin'){
    header('Location: /index');
    exit();
}

if(!empty($_GET['id']))
{
    $user = User::get(array('id' => $_GET['id']));
    $title = "Edition de l'utilisateur: ".$user->login;
    $action = "/admin/edit_user";
}
else
{
    $title = 'Nouvel utilisateur';
    $action = "/admin/new_user";
}
include 'views/admin/user.php';
?>
