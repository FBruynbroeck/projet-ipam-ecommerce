<?php
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(!empty($_SESSION['login']))
{
    unset($_SESSION['id']);
    unset($_SESSION['login']);
    unset($_SESSION['role']);
//    session_unset(); // unset $_SESSION variable for the run-time
//    session_destroy(); // destroy session data in storage
}
header('Location: /index');
?>
