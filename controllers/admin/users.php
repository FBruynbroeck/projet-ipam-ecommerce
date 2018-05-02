<?php
require 'models/user.php';
session_start();
if(empty($_SESSION['role']) or $_SESSION['role'] != 'Admin'){
    header('Location: /index');
    exit();
}
$users = User::get();
include 'views/admin/users.php';
?>
