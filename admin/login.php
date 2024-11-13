<?php
session_start(); // Inicia a sessão

if (isset($_POST['submit'])) {
    $admin_username = "admin";
    $admin_password = "Tafai123";

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == $admin_username && $password == $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php'); // Redireciona para a página de administração
        exit;
    } else {
        $error = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Admin</title>
</head>
<body>
    <h1>Login do Administrador</h1>
    <form method="POST" action="login.php">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="submit">Entrar</button>
    </form>

    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
</body>
</html>
