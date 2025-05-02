<?php
// Definição das constantes para a conexão com o banco de dados.
define("HOST","localhost"); // Endereço do servidor do banco de dados.
define("USUARIO","root"); // Nome do usuário do banco de dados.
define("SENHA","root"); // Senha do banco de dados.
define("DB","crud"); // Nome do banco de dados.

// Criação da conexão com o banco de dados usando as constantes definidas.
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) 
    or die('Não foi possível conectar'); // Caso a conexão falhe, exibe a mensagem de erro e encerra o script.
?>
