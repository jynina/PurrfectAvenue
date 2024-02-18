<?php

$hostName = 'localhost';
$dbUser = 'root';
$dbPassword = 'Z87=S|4~:fG%';
$dbName = 'purrfect';
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>