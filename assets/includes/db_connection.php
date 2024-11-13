<?php
$servername = "localhost";
$username = "root";
$password = ""; // Senha padrão do MySQL
$dbname = "produtos_tafai"; // Nome do seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
