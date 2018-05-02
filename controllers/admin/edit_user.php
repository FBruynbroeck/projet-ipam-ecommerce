<?php
require 'models/user.php';
session_start();
if(empty($_SESSION['role']) or $_SESSION['role'] != 'Admin'){
    header('Location: /index');
    exit();
}

if(!empty($_POST['id']))
{
    $user = User::get(array('id' => $_POST['id']));
    $user->login = $_POST['login'];
    if ($_POST['password'] === $_POST['passwordconfirm']){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->password = $password;
    }
    $user->save();
    header('Location: /admin/users');
    exit();
}
?>
