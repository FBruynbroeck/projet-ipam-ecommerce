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
    $user->delete();
    header('Location: /admin/users');
    exit();
}
