<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Registro de Usuário</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Inserir Usuário</button>
        </form>

        <?php
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
