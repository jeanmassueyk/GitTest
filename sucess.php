<?php
// Redirecionar para o formulário após 5 segundos
header("refresh:5;url=form_register.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Bem-Sucedido</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .success-container {
            text-align: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .success-container h1 {
            font-size: 2rem;
            color: #28a745;
        }
        .success-container p {
            font-size: 1rem;
            color: #6c757d;
        }
        .success-container a {
            text-decoration: none;
            color: #007bff;
        }
        .success-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>Registro Bem-Sucedido!</h1>
        <p>Seu usuário foi registrado com sucesso.</p>
        <p>Você será redirecionado para o formulário em 5 segundos.</p>
        <p>Se o redirecionamento não funcionar, <a href="form_register.php">clique aqui</a>.</p>
    </div>
</body>
</html>