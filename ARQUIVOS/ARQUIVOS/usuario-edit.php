<?php
session_start(); // Inicia a sessão para armazenar mensagens e dados temporários do usuário.
require 'ARQUIVOS/conexao.php'; // Importa a conexão com o banco de dados.
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios-Editar</title>
    <!-- Importação do Bootstrap para estilização -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
   <?php include('ARQUIVOS/navbar.php'); ?> <!-- Inclusão da barra de navegação -->

    <div class="container nt-5">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar usuário
                        <a href="index.php" class="btn btn-danger float-end">Voltar</a> <!-- Botão para retornar à tela principal -->
                    </h4>
                </div>
                <div class="card-body">
                    <?php 
                    if(isset($_GET['id'])){ // Verifica se o ID do usuário foi passado na URL.
                        $usuario_id = mysqli_real_escape_string($conexao, $_GET['id']); // Protege contra SQL Injection.
                        $sql = "SELECT * FROM usuarios WHERE id='$usuario_id'"; // Busca o usuário pelo ID.
                        $query = mysqli_query($conexao, $sql);

                        if (mysqli_num_rows($query) > 0){ // Se o usuário for encontrado, preenche os campos do formulário.
                            $usuario = mysqli_fetch_array($query);
                    ?>
                    <form action="acoes.php" method="POST">
                        <input type="hidden" name="usuario_id" value="<?=$usuario['id']?>"> <!-- Campo oculto para armazenar o ID do usuário -->
                        <div class="mb-3">
                            <label for="">Nome</label>
                            <input type="text" name="nome" value="<?=$usuario['nome']?>" class="form-control"> <!-- Campo para editar o nome -->
                        </div>        
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" value="<?=$usuario['email']?>" class="form-control"> <!-- Campo para editar o e-mail -->
                        </div>                                
                        <div class="mb-3">
                            <label for="">Data de Nascimento</label>
                            <input type="date" name="data_nascimento" value="<?=$usuario['data_nascimento']?>" class="form-control"> <!-- Campo para editar a data de nascimento -->
                        </div>
                        <div class="mb-3">
                            <label for="">Senha</label>
                            <input type="password" name="senha" class="form-control"> <!-- Campo para definir nova senha -->
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="update_usuario" class="btn btn-primary">Salvar</button> <!-- Botão para salvar as alterações -->
                        </div>
                    </form>
                    <?php 
                        } else {
                            echo "<h5>Usuário não encontrado</h5>"; // Caso o usuário não seja encontrado, exibe mensagem.
                        } 
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
