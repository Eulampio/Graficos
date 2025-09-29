<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "dados";
$port = 3310;

$mysqli = new mysqli($host, $user, $pass, $dbname, $port);
if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}
?>
