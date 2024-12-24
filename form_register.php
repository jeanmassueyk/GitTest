<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="text-center">Registro de Usuário</h1>
        <form id="userForm" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário</label>
                <input type="text" class="form-control" id="username" placeholder="Digite seu nome de usuário" required>
                <div class="invalid-feedback">Por favor, insira um nome de usuário válido.</div>
                <div class="valid-feedback">Nome de usuário válido!</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" placeholder="Digite seu e-mail" required>
                <div class="invalid-feedback">Por favor, insira um e-mail válido.</div>
                <div class="valid-feedback">E-mail válido!</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" placeholder="Digite sua senha" required>
                <div class="invalid-feedback">A senha deve ter pelo menos 6 caracteres.</div>
            </div>
            <div id="generalError" class="alert alert-danger d-none" role="alert">
                Ocorreu um erro. Tente novamente mais tarde.
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-person-plus"></i> Registrar
            </button>
        </form>
    </div>

    <script>
        const userForm = document.getElementById('userForm');
        const usernameInput = document.getElementById('username');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const generalError = document.getElementById('generalError');

        userForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Resetando feedback visual
            usernameInput.classList.remove('is-invalid', 'is-valid');
            emailInput.classList.remove('is-invalid', 'is-valid');
            passwordInput.classList.remove('is-invalid', 'is-valid');
            generalError.classList.add('d-none');

            const username = usernameInput.value.trim();
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();

            let isValid = true;

            // Validação básica no frontend
            if (username.length < 3) {
                usernameInput.classList.add('is-invalid');
                isValid = false;
            } else {
                usernameInput.classList.add('is-valid');
            }

            if (!email.includes('@') || email.length < 5) {
                emailInput.classList.add('is-invalid');
                isValid = false;
            } else {
                emailInput.classList.add('is-valid');
            }

            if (password.length < 6) {
                passwordInput.classList.add('is-invalid');
                isValid = false;
            } else {
                passwordInput.classList.add('is-valid');
            }

            if (!isValid) return;

            try {
                const response = await fetch('validate_user.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username, email, password })
                });

                const result = await response.json();

                if (result.usernameExists) {
                    usernameInput.classList.add('is-invalid');
                    usernameInput.nextElementSibling.textContent = 'O nome de usuário já está em uso.';
                } else if (result.emailExists) {
                    emailInput.classList.add('is-invalid');
                    emailInput.nextElementSibling.textContent = 'O e-mail já está em uso.';
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
            }
        });
    </script>
</body>
</html>