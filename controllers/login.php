<?php
require 'models/user.php';
$error = '';
// Test de l'envoi du formulaire
//if($_SERVER['REQUEST_METHOD'] == 'POST')
if(!empty($_POST))
{
    // Les identifiants sont transmis ?
    if(!empty($_POST['login']) && !empty($_POST['password']))
    {
        $user = User::get(array('login' => $_POST['login']));
        // Sont-ils les mêmes que les constantes ?
        if(!$user)
        {
            $error = 'Mauvais login !';
        }
        elseif(!password_verify($_POST['password'], $user->password))
        {
            $error = 'Mauvais password !';
        }
        else
        {
            // On ouvre la session
            session_start();
            // On enregistre le login en session
            $_SESSION['id'] = $user->id;
            $_SESSION['login'] = $user->login;
            $_SESSION['role'] = $user->role->name;
            // On redirige vers le fichier index.php
            header('Location: /index');
            exit();
        }
    }
    else
    {
        $error = 'Veuillez inscrire vos identifiants svp !';
    }
}
include 'views/login.php'
?>
