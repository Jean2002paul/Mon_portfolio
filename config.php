<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "portfolio_db";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Échec de la connexion à MySQL : " . $conn->connect_error);
}
?>
