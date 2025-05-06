<?php
session_start(); // Inicia a sessão para armazenar mensagens e dados do usuário.
require 'ARQUIVOS/conexao.php'; // Conexão com o banco de dados.

if (isset($_POST['create_usuario'])) { // Verifica se o formulário de criação foi submetido.
    // Sanitiza e protege os dados recebidos para evitar SQL Injection.
    $nome= mysqli_real_escape_string($conexao,trim($_POST['nome']) );
    $email= mysqli_real_escape_string($conexao,trim($_POST['email']) );
    $data_nascimento= mysqli_real_escape_string($conexao,trim($_POST['data_nascimento']) );
    $senha= isset($_POST['senha']) ? mysqli_real_escape_string($conexao,password_hash(trim($_POST['senha']),PASSWORD_DEFAULT))  : '';

    // Query para inserir um novo usuário no banco de dados.
    $sql="INSERT INTO usuarios (nome, email, data_nascimento, senha) VALUES ('$nome', '$email', '$data_nascimento', '$senha')";

    mysqli_query($conexao, $sql); // Executa a inserção no banco de dados.

    // Verifica se houve sucesso na operação e retorna mensagem ao usuário.
    if(mysqli_affected_rows($conexao)> 0){
        $_SESSION['mensagem']='Usuário criado com sucesso';
        header("Location:index.php"); // Redireciona para a página inicial.
        exit;
    } else {
        $_SESSION['mensagem']='Usuário não foi criado';
        header("Location:index.php");
        exit;
    }
}

if (isset($_POST['update_usuario'])) { // Verifica se o formulário de edição foi submetido.
    // Sanitiza e protege os dados recebidos para evitar SQL Injection.
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
    $senha = trim($_POST['senha']);

    // Monta a query de atualização do usuário.
    $sql = "UPDATE usuarios SET nome='$nome', email='$email', data_nascimento='$data_nascimento'";

    if (!empty($senha)) { // Se a senha for alterada, aplica o hash antes de salvar.
        $sql .= ", senha='" . password_hash($senha, PASSWORD_DEFAULT) . "'";
    }

    $sql .= " WHERE id='$usuario_id'"; // Define qual usuário será atualizado.

    mysqli_query($conexao, $sql); // Executa a atualização no banco.

    // Verifica se houve sucesso na operação e retorna mensagem ao usuário.
    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Usuário atualizado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi atualizado';
    }

    header("Location: index.php"); // Redireciona para a página inicial.
    exit;
}

if (isset($_POST["delete_usuario"])) { // Verifica se o formulário de exclusão foi submetido.
    $usuario_id = mysqli_real_escape_string($conexao, $_POST["delete_usuario"]); // Protege contra SQL Injection.

    // Query para deletar o usuário com base no ID.
    $sql="DELETE FROM usuarios WHERE id ='$usuario_id'";
    mysqli_query($conexao, $sql); // Executa a exclusão.

    // Verifica se houve sucesso na operação e retorna mensagem ao usuário.
    if (mysqli_affected_rows($conexao) > 0){
        $_SESSION['mensagem'] = 'Usuário deletado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Usuário não encontrado';
    }

    header('Location: index.php'); // Redireciona para a página inicial.
    exit;
}
?>
