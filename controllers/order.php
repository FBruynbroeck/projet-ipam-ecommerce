<?php
    require 'models/user.php';
    require 'models/item.php';
    require 'models/book.php';
    session_start();
    $user = User::get(array('id' => $_SESSION['id']));
    $items = array();
    foreach($_SESSION['cart'] as $id => $value) {
        $item = Item::get(array('id' => $id));
        foreach (range(1, $value['quantity']) as $number) {
            array_push($items, $item);
        }
    }
    $book = new Book(array('user' => $user, 'items' => $items));
    $book->save();
    unset($_SESSION['cart']);
    header('Location: /index');
?>
