<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "dados";
$port = 3306;

$mysqli = new mysqli($host, $user, $pass, $dbname, $port);
if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}
?>
