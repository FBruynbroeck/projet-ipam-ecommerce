<?php
session_start();
if(isset($_POST['total_cart_items'])){
    if (!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    $total = 0;
    foreach($_SESSION['cart'] as $id => $value){
        $total += $value['quantity'];
    }
    echo $total;
    exit();
}
if(isset($_POST['add_cart_item'])){
    if (!isset($_SESSION['cart'][$_POST['id']])) {
        $_SESSION['cart'][$_POST['id']]['quantity'] = 1;
    }
    else {
        $_SESSION['cart'][$_POST['id']]['quantity'] += 1;
    }
    exit();
}
if(isset($_POST['id']) and isset($_POST['quantity'])){
    if ($_POST['quantity'] == 0) {
        unset($_SESSION['cart'][$_POST['id']]);
    }
    else {
        $_SESSION['cart'][$_POST['id']]['quantity'] = $_POST['quantity'];
    }
    exit();
}

?>
