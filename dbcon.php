<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "phptutorials";

$con = mysqli_connect($host, $username, $password, $database);

// Vérifier la connexion
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

?>