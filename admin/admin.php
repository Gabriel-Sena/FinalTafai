<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="../css/pages-css/admin.css"> <!-- Link para o CSS -->
</head>

<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php'); // Redireciona para o login se não estiver autenticado
    exit;
}

require_once '../assets/includes/db_connection.php'; // Arquivo que contém a conexão com o banco de dados

// Função para adicionar um novo produto
if (isset($_POST['add_product'])) {
    $codigo = $_POST['codigo'];
    $codigo_barras = $_POST['codigo_barras'];
    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $caixa_peso = $_POST['caixa_peso'];
    $preco = $_POST['preco'];
    $imagem_principal = $_POST['imagem_principal'];
    $imagem_unidade = $_POST['imagem_unidade'];
    $descricao = $_POST['descricao'];
    $validade = $_POST['validade'];
    $dimensoes = $_POST['dimensoes'];

    $sql = "INSERT INTO produtos (codigo, codigo_barras, nome, marca, caixa_peso, preco, imagem_principal, imagem_unidade, descricao, validade, dimensoes) VALUES ('$codigo', '$codigo_barras', '$nome', '$marca', '$caixa_peso', '$preco', '$imagem_principal', '$imagem_unidade', '$descricao', '$validade', '$dimensoes')";
    $conn->query($sql);
}

// Função para editar um produto
if (isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $codigo_barras = $_POST['codigo_barras'];
    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $caixa_peso = $_POST['caixa_peso'];
    $preco = $_POST['preco'];
    $imagem_principal = $_POST['imagem_principal'];
    $imagem_unidade = $_POST['imagem_unidade'];
    $descricao = $_POST['descricao'];
    $validade = $_POST['validade'];
    $dimensoes = $_POST['dimensoes'];

    $sql = "UPDATE produtos SET codigo='$codigo', codigo_barras='$codigo_barras', nome='$nome', marca='$marca', caixa_peso='$caixa_peso', preco='$preco', imagem_principal='$imagem_principal', imagem_unidade='$imagem_unidade', descricao='$descricao', validade='$validade', dimensoes='$dimensoes' WHERE id=$id";
    $conn->query($sql);
}

// Função para excluir um produto
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM produtos WHERE id=$id";
    $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
</head>
<body>
    <h1>Painel Administrativo</h1>
    <p><a href="logout.php">Sair</a></p>

    <h2>Adicionar Novo Produto</h2>
    <form method="POST" action="admin.php">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" required><br><br>

        <label for="codigo_barras">Código de Barras:</label>
        <input type="text" name="codigo_barras" required><br><br>

        <label for="nome">Nome do Produto:</label>
        <input type="text" name="nome" required><br><br>

        <label for="marca">Marca:</label>
        <input type="text" name="marca" required><br><br>

        <label for="caixa_peso">Caixa/Peso:</label>
        <input type="text" name="caixa_peso" required><br><br>

        <label for="preco">Preço:</label>
        <input type="text" name="preco" required><br><br>

        <label for="preco">Imagem Principal:</label>
        <input type="text" name="imagem_principal" required><br><br>

        <label for="preco">Imagem Unidade:</label>
        <input type="text" name="imagem_unidade" required><br><br>

        <label for="preco">Descrição:</label>
        <input type="text" name="descricao" required><br><br>

        <label for="preco">Validade:</label>
        <input type="text" name="validade" required><br><br>

        <label for="preco">Dimensões:</label>
        <input type="text" name="dimensoes" required><br><br>

        <button type="submit" name="add_product">Adicionar Produto</button>
    </form>

    <h2>Produtos Cadastrados</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Código de Barras</th>
                <th>Produto</th>
                <th>Marca</th>
                <th>Caixa/Peso</th>
                <th>Preço</th>
                <th>Imagem Principal</th>
                <th>Imagem Unidade</th>
                <th>Descrição</th>
                <th>Validade</th>
                <th>Dimensões</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM produtos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['codigo'] . "</td>";
                    echo "<td>" . $row['codigo_barras'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['marca'] . "</td>";
                    echo "<td>" . $row['caixa_peso'] . "</td>";
                    echo "<td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>";
                    echo "<td>" . $row['imagem_principal'] . "</td>";
                    echo "<td>" . $row['imagem_unidade'] . "</td>";
                    echo "<td>" . $row['descricao'] . "</td>";
                    echo "<td>" . $row['validade'] . "</td>";
                    echo "<td>" . $row['dimensoes'] . "</td>";
                    echo "<td><a href='admin.php?edit=" . $row['id'] . "'>Editar</a> | <a href='admin.php?delete=" . $row['id'] . "'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhum produto encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Se editar um produto
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM produtos WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
        <h2>Editar Produto</h2>
        <form method="POST" action="admin.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label for="codigo">Código:</label>
            <input type="text" name="codigo" value="<?php echo $row['codigo']; ?>" required><br><br>

            <label for="codigo_barras">Código de Barras:</label>
            <input type="text" name="codigo_barras" value="<?php echo $row['codigo_barras']; ?>" required><br><br>

            <label for="nome">Nome do Produto:</label>
            <input type="text" name="nome" value="<?php echo $row['nome']; ?>" required><br><br>

            <label for="marca">Marca:</label>
            <input type="text" name="marca" value="<?php echo $row['marca']; ?>" required><br><br>

            <label for="caixa_peso">Caixa/Peso:</label>
            <input type="text" name="caixa_peso" value="<?php echo $row['caixa_peso']; ?>" required><br><br>

            <label for="preco">Preço:</label>
            <input type="text" name="preco" value="<?php echo $row['preco']; ?>" required><br><br>

            <label for="preco">Imagem Principal:</label>
            <input type="text" name="imagem_principal" value="<?php echo $row['imagem_principal']; ?>" required><br><br>

            <label for="preco">Imagem Unidade:</label>
            <input type="text" name="imagem_unidade" value="<?php echo $row['imagem_unidade']; ?>" required><br><br>

            <label for="preco">Descrição:</label>
            <input type="text" name="descricao" value="<?php echo $row['descricao']; ?>" required><br><br>

            <label for="preco">Validade:</label>
            <input type="text" name="validade" value="<?php echo $row['validade']; ?>" required><br><br>

            <label for="preco">Dimensões:</label>
            <input type="text" name="dimensoes" value="<?php echo $row['dimensoes']; ?>" required><br><br>

            <button type="submit" name="edit_product">Atualizar Produto</button>
        </form>
    <?php } ?>
</body>
</html>
