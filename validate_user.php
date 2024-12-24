<?php
header('Content-Type: application/json');

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'seu_banco_de_dados');

if ($conn->connect_error) {
    die(json_encode(['error' => 'Erro na conexão com o banco de dados']));
}

$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$email = $data['email'];

$response = [
    'usernameExists' => false,
    'emailExists' => false
];

// Verificar se o nome de usuário já existe
$stmt = $conn->prepare('SELECT id FROM usuarios WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $response['usernameExists'] = true;
}
$stmt->close();

// Verificar se o e-mail já existe
$stmt = $conn->prepare('SELECT id FROM usuarios WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $response['emailExists'] = true;
}
$stmt->close();

$conn->close();

echo json_encode($response);