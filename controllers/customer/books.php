<?php
require 'models/book.php';
session_start();
if(empty($_SESSION['role']) or !in_array($_SESSION['role'], array('Customer', 'Admin'))){
    header('Location: /index');
    exit();
}
$books = Book::get(array('user_id' => $_SESSION['id']));
include 'views/customer/books.php';
?>
