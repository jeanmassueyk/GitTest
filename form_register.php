<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
<<<<<<< HEAD
        :root {
            --bg-color: #f8f9fa;
            --text-color: #333;
            --panel-bg: #ffffff;
            --btn-primary-bg: #007bff;
            --btn-primary-border: #007bff;
            --btn-primary-hover-bg: #0056b3;
            --btn-primary-hover-border: #004085;
            --input-bg: #ffffff;
            --input-text: #333;
        }

=======
        /* Estilização personalizada */
>>>>>>> parent of d2a2b53 (Update form_register.php)
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
<<<<<<< HEAD
            background-color: var(--panel-bg);
=======
            background-color: #ffffff;
>>>>>>> parent of d2a2b53 (Update form_register.php)
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .form-container img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .input-group-text {
<<<<<<< HEAD
            background-color: var(--input-bg);
            color: var(--input-text);
        }

        .form-control {
            background-color: var(--input-bg);
            color: var(--input-text);
        }

        /* Estilos para o tema escuro */
        body.dark-mode {
            --bg-color: #121212;
            --text-color: #ffffff;
            --panel-bg: #1e1e1e;
            --btn-primary-bg: #bb86fc;
            --btn-primary-border: #bb86fc;
            --btn-primary-hover-bg: #9b59b6;
            --btn-primary-hover-border: #8e44ad;
            --input-bg: #2c2c2c;
            --input-text: #ffffff;
        }

        .theme-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-color);
        }
    </style>
</head>
<body>
    <!-- Botão para alternar o modo escuro -->
    <button class="theme-toggle" id="themeToggle" title="Alternar tema">
        <i class="fas fa-moon"></i>
    </button>

=======
            background-color: #e9ecef;
        }
        /* Alinhar os labels à esquerda */
        .form-label {
            text-align: left;
            display: block;
        }
        /* Ajustar os botões */
        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px; /* Espaçamento entre os botões */
        }
    </style>
</head>
<body>
>>>>>>> parent of d2a2b53 (Update form_register.php)
    <div class="form-container">
        <!-- Adicionando a logo -->
        <img src="https://truvo.com.br/_astro/logo.92936995.png" alt="Logo da Empresa" class="img-fluid">
        <br>
        <br>
        <h5 class="text-center">Registro de Usuário</h5>
        <form id="userForm">
            <!-- Campo Nome de Usuário com label e ícone -->
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Digite seu nome de usuário" required>
                </div>
            </div>

            <!-- Campo E-mail com label e ícone -->
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>
            </div>

            <!-- Campo Senha com label e ícone -->
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                    <span class="input-group-text">
                        <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>

            <!-- Botões de ação -->
            <br>
            <br>
            <div class="d-flex justify-content-center gap-2">
                <button type="submit" class="btn btn-primary">Registrar</button>
                <button type="reset" class="btn btn-secondary">Limpar</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript para Toggle de Senha e Tema -->
    <script>
<<<<<<< HEAD
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;

        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            body.classList.add(savedTheme);
            updateThemeIcon(savedTheme);
        }

        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            const currentTheme = body.classList.contains('dark-mode') ? 'dark-mode' : '';
            localStorage.setItem('theme', currentTheme);
            updateThemeIcon(currentTheme);
        });

        function updateThemeIcon(theme) {
            const icon = themeToggle.querySelector('i');
            if (theme === 'dark-mode') {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
=======
        const userForm = document.getElementById('userForm');
        const usernameInput = document.getElementById('username');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const usernameError = document.getElementById('usernameError');
        const emailError = document.getElementById('emailError');
        const generalError = document.getElementById('generalError');

        userForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const username = usernameInput.value;
            const email = emailInput.value;
            const password = passwordInput.value;

            try {
                const response = await fetch('validate_user.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username, email, password })
                });

                const result = await response.json();

                if (result.usernameExists) {
                    usernameError.textContent = 'O nome de usuário já está em uso.';
                } else if (result.emailExists) {
                    emailError.textContent = 'O e-mail já está em uso.';
                } else if (result.success) {
                    alert('Usuário registrado com sucesso!');
                    window.location.href = 'sucess.php';
                } else {
                    generalError.classList.remove('d-none');
                    generalError.textContent = result.message || 'Erro desconhecido.';
                }
            } catch (error) {
                console.error('Erro ao validar os dados:', error);
                generalError.classList.remove('d-none');
                generalError.textContent = 'Erro ao processar a solicitação.';
>>>>>>> parent of d2a2b53 (Update form_register.php)
            }
        }

        // Envio do formulário
        const form = document.getElementById('userForm');
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Evita o envio padrão
            const formData = new FormData(form);
            console.log('Dados enviados:', Object.fromEntries(formData));
            alert('Formulário enviado com sucesso!');
        });
    </script>
</body>
</html>