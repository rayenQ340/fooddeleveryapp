<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "food_delivery";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
?>
