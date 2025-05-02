<?php
session_start(); // Inicia a sessão para armazenar dados do usuário.
require 'ARQUIVOS/conexao.php'; // Importa a conexão com o banco de dados.
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    <!-- Importação do Bootstrap para estilização -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include('ARQUIVOS/navbar.php'); ?> <!-- Inclusão da barra de navegação -->

    <div class="conteiner nt-4">
        <?php include('ARQUIVOS/mensagem.php');?> <!-- Exibição de mensagens de erro ou sucesso -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Usuários
                            <a href="usuario_create.php" class="btn btn-primary float-end">Adicionar usuário</a> <!-- Botão para adicionar novo usuário -->
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Data Nascimento</th>
                                    <th>Ações</th> <!-- Coluna para ações -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = 'SELECT * FROM usuarios'; // Consulta para recuperar todos os usuários
                                $usuarios = mysqli_query($conexao, $sql); // Executa a consulta

                                if(mysqli_num_rows($usuarios) > 0){ // Verifica se há usuários cadastrados
                                    foreach($usuarios as $usuario){
                                ?>
                                <tr>
                                    <td><?=$usuario['id']?></td>
                                    <td><?=$usuario['nome']?></td>
                                    <td><?=$usuario['email']?></td>
                                    <td><?=date("d/n/Y", strtotime($usuario['data_nascimento']))?></td> <!-- Formatação da data -->
                                    <td>
                                        <a href="usuario-view.php?id=<?=$usuario['id']?>" class="btn btn-secondary btn-sn">
                                            <span class="bi-eye-fill"></span>&nbspVisualizar <!-- Botão para visualizar -->
                                        </a>
                                        <a href="usuario-edit.php?id=<?=$usuario['id']?>" class="btn btn-success btn-sn">
                                            <span class="bi-pencil-fill"></span>&nbspEditar <!-- Botão para editar -->
                                        </a>
                                        <form action="acoes.php" method="POST" class="d-inline">
                                            <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_usuario" value="<?=$usuario['id']?>" class="btn btn-danger btn-sn">
                                                <span class="bi-trash3-fill"></span>&nbspExcluir <!-- Botão para excluir usuário -->
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php 
                                    } 
                                } else {
                                    echo "<h5> Nenhum usuário encontrado</h5>"; // Mensagem caso não haja registros
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
