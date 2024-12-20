<!DOCTYPE html>
<html lang="pt_Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: white;
        }
        .form-label {
            color: white;
        }
        .logo {
            display: block;
            margin: 0 auto;
            max-width: 150px; /* Ajuste o tamanho da logo conforme necessário */
            height: auto;
        }
        /* Estilo para a classe inputstyle */
        .inputstyle {
            background-color: #2E2E2E; /* Cor de fundo */
            color: white; /* Cor do texto para contraste */
            border: 1px solid #444; /* Bordas para melhor visualização */
            border-radius: 4px; /* Bordas arredondadas */
        }
        .inputstyle:focus {
            background-color: #3A3A3A; /* Cor de fundo ao focar o campo */
            outline: none; /* Remove o contorno padrão */
            color: white; /* Cor do texto para contraste */
        }
        /* Estilo para o span do Telefone do Cliente */
        .input-group-text {
            background-color: #2E2E2E; /* Cor de fundo */
            color: white; /* Cor do texto */
            border: 1px solid #444; /* Bordas */
        }
        /* Estilo para o select */
        .form-select.inputstyle {
            background-color: #2E2E2E; /* Cor de fundo */
            color: white; /* Cor do texto */
            border: 1px solid #444; /* Bordas */
        }
        /* Estilo para o textarea */
        textarea.inputstyle {
            background-color: #2E2E2E; /* Cor de fundo */
            color: white; /* Cor do texto */
            border: 1px solid #444; /* Bordas */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Logo -->
        <div class="text-center mb-4">
            <img src="https://sistemas.jeanmassueyk.com.br/GitTest/imgs/truvologo.png" alt="Logo" class="logo">
        </div>

        <h1 class="text-center mb-4">Envio de Mensagem Automática What's App</h1>
        <form action="process_form.php" method="POST">
            <!-- Nome do Cliente -->
            <div class="mb-3">
                <label for="nomeCliente" class="form-label">Nome do Cliente</label>
                <input type="text" class="form-control inputstyle" id="nomeCliente" name="nomeCliente" required>
            </div>

            <!-- Endereço, Complemento e Número do Pedido -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="endereco" class="form-label">Endereço </label>
                    <input type="text" class="form-control inputstyle" id="endereco" name="endereco" required>
                </div>
                <div class="col-md-4">
                    <label for="complemento" class="form-label">Complemento </label>
                    <input type="text" class="form-control inputstyle" id="complemento" name="complemento" required>
                </div>
                <div class="col-md-4">
                    <label for="numeroPedido" class="form-label">Número do Pedido </label>
                    <input type="text" class="form-control inputstyle" id="numeroPedido" name="numeroPedido" required>
                </div>
            </div>

            <!-- Telefone do Cliente, Estabelecimento e Usuário -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="telefoneCliente" class="form-label">Telefone do Cliente </label>
                    <div class="input-group">
                        <span class="input-group-text inputstyle">+55</span>
                        <input type="tel" class="form-control inputstyle" id="telefoneCliente" name="telefoneCliente" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="estabelecimento" class="form-label">Estabelecimento </label>
                    <select class="form-select inputstyle" id="estabelecimento" name="estabelecimento" required>
                        <option value="" selected disabled>Selecione</option>
                        <option value="Delizia Pizza Frita">Delizia Pizza Frita</option>
                        <option value="Di Calabria">Di Calabria</option>
                        <option value="Distrito Oriental">Distrito Oriental</option>
                        
                        
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="usuario" class="form-label">Usuário </label>
                    <select class="form-select inputstyle" id="usuario" name="usuario" required>
                        <option value="" selected disabled>Selecione</option>
                        <option value="Usuário 1">Breno</option>
                        <option value="Usuário 2">Carlos</option>
                        <option value="Usuário 2">Jean Massueyk</option>
                        <option value="Usuário 2">Luis</option>
                    </select>
                </div>
            </div>

            <!-- Área para colar -->
            <div class="mb-3">
                <label for="areaColar" class="form-label">Área de copiar e colar</label>
                <textarea class="form-control inputstyle" id="areaColar" name="areaColar" rows="3"></textarea>
            </div>

            <!-- Botões -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <button type="reset" class="btn btn-secondary">Limpar</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>