<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="text-center">Registro de Usuário</h1>
        <form id="userForm">
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário</label>
                <input type="text" class="form-control" id="username" placeholder="Digite seu nome de usuário" required>
                <small id="usernameError" class="text-danger"></small>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" placeholder="Digite seu e-mail" required>
                <small id="emailError" class="text-danger"></small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" placeholder="Digite sua senha" required>
                <small id="passwordError" class="text-danger"></small>
            </div>
            <div id="generalError" class="alert alert-danger d-none" role="alert">
                Ocorreu um erro. Tente novamente mais tarde.
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

    <script>
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
            }
        });
    </script>
</body>
</html>