<!DOCTYPE html>
<html lang="en">
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
                <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" required>
            </div>

            <!-- Endereço, Complemento e Número do Pedido -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="endereco" class="form-label">Endereço </label>
                    <input type="text" class="form-control" id="endereco" name="endereco" required>
                </div>
                <div class="col-md-4">
                    <label for="complemento" class="form-label">Complemento </label>
                    <input type="text" class="form-control" id="complemento" name="complemento" required>
                </div>
                <div class="col-md-4">
                    <label for="numeroPedido" class="form-label">Número do Pedido </label>
                    <input type="text" class="form-control" id="numeroPedido" name="numeroPedido" required>
                </div>
            </div>

            <!-- Telefone do Cliente, Estabelecimento e Usuário -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="telefoneCliente" class="form-label">Telefone do Cliente </label>
                    <div class="input-group">
                        <span class="input-group-text">+55</span>
                        <input type="tel" class="form-control" id="telefoneCliente" name="telefoneCliente" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="estabelecimento" class="form-label">Estabelecimento </label>
                    <select class="form-select" id="estabelecimento" name="estabelecimento" required>
                        <option value="" selected disabled>Selecione</option>
                        <option value="Estabelecimento 1">Estabelecimento 1</option>
                        <option value="Estabelecimento 2">Estabelecimento 2</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="usuario" class="form-label">Usuário </label>
                    <select class="form-select" id="usuario" name="usuario" required>
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
                <textarea class="form-control" id="areaColar" name="areaColar" rows="3"></textarea>
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