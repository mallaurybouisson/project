<?php
session_start();
include('config/functions.php');

unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);

redirect("login.php", "Vous vous êtes déconnecté avec succès");


?>