<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST['login']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verifica se o login já existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE login = ?");
    $stmt->execute([$login]);
    if ($stmt->fetch()) {
        $error = "Login já existe.";
    } else {
        // Insere o usuário
        $stmt = $pdo->prepare("INSERT INTO usuarios (login, senha) VALUES (?, ?)");
        if ($stmt->execute([$login, $senha])) {
            $_SESSION['user_id'] = $pdo->lastInsertId();
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Erro ao cadastrar usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Cadastro de Usuário</title>
</head>

<body>
    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="index.php" class="btn btn-link">Já tem uma conta? Faça login.</a>
        </form>
    </div>
</body>

</html>