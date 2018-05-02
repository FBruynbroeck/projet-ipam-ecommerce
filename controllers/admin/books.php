<?php
require 'models/book.php';
session_start();
if(empty($_SESSION['role']) or $_SESSION['role'] != 'Admin'){
    header('Location: /index');
    exit();
}
$books = Book::get();
include 'views/admin/books.php';
?>
