<?php
$servername = "localhost";
$username = "root";
$password = "";
$basename = "projekt";
$port = 3307;

$dbc = mysqli_connect($servername, $username, $password, $basename, $port) or die('Error
connecting to MySQL server.'.mysqli_error($mysql));
mysqli_set_charset($dbc, "utf8");
?>

