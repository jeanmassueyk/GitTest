<?php
// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexão com o banco de dados
    $host = 'bb12ce777f6e';
    $dbname = 'lamp_db';
    $dbuser = 'user';  // substitua pelo usuário do banco de dados, se necessário
    $dbpassword = 'password';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validação básica
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Criptografar a senha (usando password_hash)
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Inserir os dados
            $sql = "INSERT INTO usuarios (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);

            if ($stmt->execute()) {
                // Redirecionar para evitar reenvio do formulário
                header('Location: ' . $_SERVER['PHP_SELF'] . '?success=1');
                exit;
            } else {
                $error_message = "Erro ao inserir o usuário.";
            }
        } catch (PDOException $e) {
            $error_message = "Erro de conexão: " . $e->getMessage();
        }
    } else {
        $error_message = "Por favor, preencha todos os campos.";
    }
}

// Exibir mensagem de sucesso, se aplicável
$success_message = '';
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success_message = "Usuário inserido com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilização personalizada */
        body {
            background-color: #f8f9fa; /* Fundo claro para contraste */
            font-family: 'Arial', sans-serif;
            height: 100vh; /* Altura total da viewport */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .form-container {
            min-width: 510px; /* Largura mínima de 510px */
            max-width: 500px;
            padding: 20px;
            background-color: #ffffff; /* Fundo branco para o formulário */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
            text-align: center; /* Centralizar conteúdo */
        }
        .form-container h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #343a40; /* Cor do título */
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .alert {
            font-size: 0.9rem;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }
        .form-control {
            border-left: none;
        }
        .input-group .form-control:focus {
            box-shadow: none;
        }
        .toggle-password {
            cursor: pointer;
        }
        .logo {
            max-width: 100px; /* Tamanho máximo da logo */
            margin-bottom: 20px;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px; /* Espaço entre os botões */
        }
        .form-label {
            text-align: left; /* Alinhar os labels à esquerda */
            display: block; /* Garantir que o label ocupe toda a largura */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Adicionando a logo -->
        <img src="https://sistemas.jeanmassueyk.com.br/GitTest/imgs/truvologo.png" alt="Logo" class="logo">
        <h1 class="text-center">Registro de Usuário</h1>
        <form id="userForm" method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Digite seu nome de usuário" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                    <span class="input-group-text toggle-password"><i class="bi bi-eye-slash" id="togglePasswordIcon"></i></span>
                </div>
            </div>
            <!-- Botões centralizados -->
             <br>
             <br>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">Inserir Usuário</button>
                <button type="button" class="btn btn-secondary" id="clearButton">Limpar</button>
            </div>
        </form>

        <?php if (!empty($success_message)): ?>
            <div id="successMessage" class="alert alert-success mt-3"><?= $success_message ?></div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger mt-3"><?= $error_message ?></div>
        <?php endif; ?>
    </div>
</body>
</html>