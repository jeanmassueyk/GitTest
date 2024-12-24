<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Registro de Usuário</h1>
        <form method="POST" action="">
            <!-- Campo Nome de Usuário com toggle -->
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Digite seu nome de usuário" required>
                    <span class="input-group-text" id="toggle-username">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>

            <!-- Campo E-mail com toggle -->
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <div class="input-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                    <span class="input-group-text" id="toggle-email">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>

            <!-- Campo Senha com exibir/ocultar -->
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                    <span class="input-group-text" id="toggle-password">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        // Função para alternar a visibilidade do campo Nome de Usuário
        const usernameInput = document.getElementById('username');
        const toggleUsername = document.getElementById('toggle-username');
        toggleUsername.addEventListener('click', () => {
            if (usernameInput.type === 'text') {
                usernameInput.type = 'password';
                toggleUsername.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                usernameInput.type = 'text';
                toggleUsername.innerHTML = '<i class="bi bi-eye"></i>';
            }
        });

        // Função para alternar a visibilidade do campo E-mail
        const emailInput = document.getElementById('email');
        const toggleEmail = document.getElementById('toggle-email');
        toggleEmail.addEventListener('click', () => {
            if (emailInput.type === 'text') {
                emailInput.type = 'email';
                toggleEmail.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                emailInput.type = 'text';
                toggleEmail.innerHTML = '<i class="bi bi-eye"></i>';
            }
        });

        // Função para exibir/ocultar a senha
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('toggle-password');
        togglePassword.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePassword.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                togglePassword.innerHTML = '<i class="bi bi-eye"></i>';
            }
        });
    </script>
</body>
</html>