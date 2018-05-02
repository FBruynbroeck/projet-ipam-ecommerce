<?php
require 'models/item.php';
session_start();
if(!empty($_GET['id']))
{
    $item = Item::get(array('id' => $_GET['id']));
}
include 'views/item.php';
?>
