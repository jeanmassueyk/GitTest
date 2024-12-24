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
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .form-container {
            min-width: 400px;
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .form-container h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #343a40;
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
            max-width: 100px;
            margin-bottom: 20px;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .form-label {
            text-align: left;
            display: block;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <img src="https://sistemas.jeanmassueyk.com.br/GitTest/imgs/truvologo.png" alt="Logo" class="logo">
        <h1 class="text-center">Registro de Usuário</h1>
        <form id="userForm" method="POST" action="validade_user.php">
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Digite seu nome de usuário" required>
                </div>
                <small id="usernameError" class="text-danger"></small>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>
                <small id="emailError" class="text-danger"></small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                    <span class="input-group-text toggle-password"><i class="bi bi-eye-slash" id="togglePasswordIcon"></i></span>
                </div>
            </div>
            <br>
            <br>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">Inserir Usuário</button>
                <button type="button" class="btn btn-secondary" id="clearButton">Limpar</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        const userForm = document.getElementById('userForm');
        const usernameInput = document.getElementById('username');
        const emailInput = document.getElementById('email');
        const usernameError = document.getElementById('usernameError');
        const emailError = document.getElementById('emailError');

        // Validação de nome de usuário (somente letras minúsculas e números)
        usernameInput.addEventListener('input', () => {
            const username = usernameInput.value;
            const regex = /^[a-z0-9]+$/;
            if (!regex.test(username)) {
                usernameError.textContent = 'O nome de usuário deve conter apenas letras minúsculas e números.';
            } else {
                usernameError.textContent = '';
            }
        });

        // Validação de e-mail e nome de usuário no banco de dados
        userForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const username = usernameInput.value;
            const email = emailInput.value;

            try {
                const response = await fetch('validate_user.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username, email })
                });

                const result = await response.json();

                if (result.usernameExists) {
                    usernameError.textContent = 'O nome de usuário já está em uso.';
                } else if (result.emailExists) {
                    emailError.textContent = 'O e-mail já está em uso.';
                } else {
                    // Submeter o formulário se não houver erros
                    userForm.submit();
                }
            } catch (error) {
                console.error('Erro ao validar os dados:', error);
            }
        });

        // Alternar visibilidade da senha
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.getElementById('password');
        const togglePasswordIcon = document.getElementById('togglePasswordIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            togglePasswordIcon.classList.toggle('bi-eye');
            togglePasswordIcon.classList.toggle('bi-eye-slash');
        });

        // Botão de limpar
        const clearButton = document.getElementById('clearButton');
        clearButton.addEventListener('click', function () {
            userForm.reset();
        });
    </script>
</body>
</html>