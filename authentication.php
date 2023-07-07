<?php
session_start();

if(!isset($_SESSION['authenticated']))
{
    $_SESSION['status'] = "Veuillez vous connecter pour accéder au profil utilisateur";
    header('Location: login.php');
    exit(0);
}

?>