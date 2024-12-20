<?php
// Configuração do endpoint do webhook
$webhookUrl = 'https://n8n.jeanmassueyk.site/webhook/form'; // Substitua pelo endpoint correto

// Função para redirecionar para a página inicial ao dar refresh
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php"); // Redireciona para a página inicial
    exit;
}

// Verifica se o formulário foi enviado via POST UP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados enviados pelo formulário
    $nomeCliente = htmlspecialchars($_POST['nomeCliente']);
    $endereco = htmlspecialchars($_POST['endereco']);
    $complemento = htmlspecialchars($_POST['complemento']);
    $numeroPedido = htmlspecialchars($_POST['numeroPedido']);
    $telefoneCliente = htmlspecialchars($_POST['telefoneCliente']);
    $estabelecimento = htmlspecialchars($_POST['estabelecimento']);
    $usuario = htmlspecialchars($_POST['usuario']);
    $areaColar = htmlspecialchars($_POST['areaColar']);

    // Monta o payload JSON a ser enviado ao webhook
    $payload = json_encode([
        'nomeCliente' => $nomeCliente,
        'endereco' => $endereco,
        'complemento' => $complemento,
        'numeroPedido' => $numeroPedido,
        'telefoneCliente' => "+55" . $telefoneCliente, // Prefixo do telefone
        'estabelecimento' => $estabelecimento,
        'usuario' => $usuario,
        'areaColar' => $areaColar,
        'dataEnvio' => date('Y-m-d H:i:s') // Timestamp do envio
    ]);

    // Inicializa o cURL
    $ch = curl_init($webhookUrl);

    // Configurações do cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload)
    ]);
 

curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Envia os dados e captura a resposta
    $response = curl_exec($ch);

    // Verifica erros de cURL
    if (curl_errno($ch)) {
        echo "<div style='color:red; text-align:center; margin-top:20px;'>
                Erro ao enviar webhook: " . curl_error($ch) . "
              </div>";
    } else {
        echo "<div style='color:green; text-align:center; margin-top:20px; font-size:18px;'>
                Mensagem enviada com sucesso! Você será redirecionado em 5 segundos...
              </div>";
        // Redirecionamento automático após 5 segundos
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 5000);
              </script>";
    }

    // Fecha a conexão cURL
    curl_close($ch);
} else {
    // Caso o usuário tente acessar diretamente a página
    header("Location: index.php");
    exit;
}
?>
