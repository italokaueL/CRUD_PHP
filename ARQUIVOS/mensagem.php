<?php  
if (isset($_SESSION['mensagem'])): // Verifica se existe uma mensagem armazenada na sessão.
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?= $_SESSION['mensagem']; ?> <!-- Exibe a mensagem armazenada na sessão -->
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> <!-- Botão para fechar o alerta -->
</div>
<?php
    unset($_SESSION['mensagem']); // Remove a mensagem da sessão após ser exibida, evitando que apareça novamente.
endif;
?>
