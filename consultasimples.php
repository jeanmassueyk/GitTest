<!DOCTYPE html>
<html>
<head>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Exemplo de Consulta a Banco de Dados com Ordenação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	
	
	
	
</head>
<body>
    <div class="container mt-4">
        <?php
        session_start(); // Iniciar a sessão . Hello World!!!!

        $servername = "127.0.0.1";
        $username = "root";
        $password = "t79pnpb3a2fafekj05!@#ab";
        $dbname = "testeapps";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Erro na conexão: " . $conn->connect_error);
        }

        // Verificar se a coluna de ordenação foi especificada
        $allowed_order_columns = ['username_id', 'username'];  // Define allowed order columns
        $orderColumn = isset($_GET['order']) && in_array($_GET['order'], $allowed_order_columns) ? $_GET['order'] : 'username_id';
        $orderDirection = isset($_GET['direction']) && $_GET['direction'] === 'desc' ? 'desc' : 'asc';

        // If the sorting parameters are present in the URL, store them in the session
        if (isset($_GET['order']) || isset($_GET['direction'])) {
            $_SESSION['orderColumn'] = $orderColumn;
            $_SESSION['orderDirection'] = $orderDirection;
        }

        // Retrieve sorting options from the session or set default values
        $orderColumn = isset($_SESSION['orderColumn']) ? $_SESSION['orderColumn'] : 'username_id';
        $orderDirection = isset($_SESSION['orderDirection']) ? $_SESSION['orderDirection'] : 'asc';

        $query = "SELECT username_id, username, password FROM app_users ORDER BY $orderColumn $orderDirection";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped">
                    <thead>
                        <tr>
                            <th><a href="?order=username_id&direction=' . ($orderDirection === 'asc' ? 'desc' : 'asc') . '">ID Nome de Usuário</a></th>
                            <th>Nome de Usuário</th>
                            <th>Senha</th>
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row["username_id"] . '</td>
                        <td>' . $row["username"] . '</td>
                        <td><span class="password-hidden">******</span><span class="password-reveal" style="display: none;">' . $row["password"] . '</span> <i class="fas fa-eye password-toggle" onclick="togglePassword(this)"></i></td>
                      </tr>';
            }
            echo '</tbody></table>';
        } else {
            echo "Nenhum resultado encontrado na tabela.";
        }

        $conn->close();
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function togglePassword(element) {
        let parentTd = element.parentElement;
        let hiddenSpan = parentTd.querySelector('.password-hidden');
        let revealSpan = parentTd.querySelector('.password-reveal');
        if (hiddenSpan.style.display === 'none') {
            hiddenSpan.style.display = '';
            revealSpan.style.display = 'none';
            element.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            hiddenSpan.style.display = 'none';
            revealSpan.style.display = '';
            element.classList.replace('fa-eye', 'fa-eye-slash');
        }
    }
</script>

</body>
</html>
