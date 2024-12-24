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
        }
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff; /* Fundo branco para o formulário */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
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
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center">Registro de Usuário</h1>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Nome de Usuário</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Digite seu nome de usuário" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Inserir Usuário</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Conexão com o banco de dados
                $host = '';
                $dbname = '';
                $dbuser = '';  // substitua pelo usuário do banco de dados, se necessário
                $dbpassword = '';

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
                            echo "<div class='alert alert-success mt-3'>Usuário inserido com sucesso!</div>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Erro ao inserir o usuário.</div>";
                        }
                    } catch (PDOException $e) {
                        echo "<div class='alert alert-danger mt-3'>Erro de conexão: " . $e->getMessage() . "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger mt-3'>Por favor, preencha todos os campos.</div>";
                }
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>