<?php
// Configuração do banco de dados
$servername = "localhost";  // ou o endereço do seu servidor
$username = "root";         // seu usuário do MySQL
$password = "";             // sua senha do MySQL
$dbname = "produtos_tafai";  // o nome do seu banco de dados

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta SQL para selecionar os produtos
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

// Verificando se há produtos no banco
if ($result->num_rows > 0) {
    // Exibindo os produtos
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['codigo'] . "</td>";
        echo "<td>" . $row['codigo_barras'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['marca'] . "</td>";
        echo "<td>" . $row['caixa_peso'] . "</td>";
        echo "<td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Nenhum produto encontrado.</td></tr>";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
