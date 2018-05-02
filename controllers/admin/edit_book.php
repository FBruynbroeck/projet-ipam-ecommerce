<?php
require_once 'models/book.php';
require_once 'models/status.php';
session_start();
if(empty($_SESSION['role']) or $_SESSION['role'] != 'Admin'){
    header('Location: /index');
    exit();
}

if(!empty($_GET['id']) and !empty($_GET['status']))
{
    $book = Book::getFirst(array('id' => $_GET['id']));
    $status = Status::get(array('id' => $_GET['status']));
    $book->status = $status;
    $book->save();
    header('Location: /admin/books');
    exit();
}
?>
