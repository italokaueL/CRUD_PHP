<?php
require 'conexao.php'; // Importa a conexão com o banco de dados.
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuario-Visualizar</title>
    <!-- Importação do Bootstrap para estilização -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('navbar.php'); ?> <!-- Inclusão da barra de navegação -->

    <div class="container nt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar usuário
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a> <!-- Botão para retornar à lista de usuários -->
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php  
                        if (isset($_GET['id'])) { // Verifica se o ID do usuário foi passado na URL.
                            $usuario_id = mysqli_real_escape_string($conexao, $_GET['id']); // Protege contra SQL Injection.
                            $sql = "SELECT * FROM usuarios WHERE id='$usuario_id';"; // Busca os dados do usuário pelo ID.
                            $query = mysqli_query($conexao, $sql);

                            if (mysqli_num_rows($query) > 0) { // Verifica se o usuário foi encontrado.
                                $usuario = mysqli_fetch_assoc($query);
                        ?>
                                <div class="mb-3">
                                    <label for="">Nome</label>
                                    <p class="form-control"><?= htmlspecialchars($usuario['nome']); ?></p> <!-- Exibe o nome do usuário -->
                                </div>        
                                <div class="mb-3">
                                    <label for="">Email</label>
                                    <p class="form-control"><?= htmlspecialchars($usuario['email']); ?></p> <!-- Exibe o email do usuário -->
                                </div>
                                <div class="mb-3">
                                    <label for="">Data de Nascimento</label>
                                    <p class="form-control"><?= date('d/m/Y', strtotime($usuario['data_nascimento'])); ?></p> <!-- Exibe a data de nascimento formatada -->
                                </div>  
                        <?php  
                            } else {
                                echo "<h5>Usuário não encontrado</h5>"; // Mensagem caso o usuário não seja encontrado.
                            }
                        } else {
                            echo "<h5>ID do usuário não fornecido</h5>"; // Mensagem caso o ID não seja passado na URL.
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
