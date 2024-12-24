<?php
// Configuração do banco de dados
$host = 'bb12ce777f6e'; // Endereço do servidor do banco de dados
$dbname = 'lamp_db'; // Nome do banco de dados
$username = 'user'; // Usuário do banco de dados
$password = 'password'; // Senha do banco de dados

// Conexão com o banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao conectar ao banco de dados.']);
    exit;
}

// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os dados foram enviados no formato JSON
    $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
    if (strpos($contentType, 'application/json') !== false) {
        // Lê os dados enviados pelo frontend
        $input = json_decode(file_get_contents('php://input'), true);

        // Verifica se os campos necessários foram enviados
        if (!isset($input['username']) || !isset($input['email'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Dados incompletos.']);
            exit;
        }

        $username = trim($input['username']);
        $email = trim($input['email']);

        // Validação básica no backend
        if (!preg_match('/^[a-z0-9]+$/', $username)) {
            echo json_encode(['usernameInvalid' => true, 'message' => 'O nome de usuário deve conter apenas letras minúsculas e números.']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['emailInvalid' => true, 'message' => 'O e-mail fornecido é inválido.']);
            exit;
        }

        try {
            // Verifica se o nome de usuário já existe no banco de dados
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM usuarios WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $usernameExists = $stmt->fetchColumn() > 0;

            // Verifica se o e-mail já existe no banco de dados
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM usuarios WHERE email = :email');
            $stmt->execute(['email' => $email]);
            $emailExists = $stmt->fetchColumn() > 0;

            // Retorna o resultado da validação
            echo json_encode([
                'usernameExists' => $usernameExists,
                'emailExists' => $emailExists
            ]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao consultar o banco de dados.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Formato de dados inválido. Certifique-se de enviar JSON.']);
    }
} else {
    http_response_code(405); // Método não permitido
    echo json_encode(['error' => 'Método não permitido. Use POST.']);
}