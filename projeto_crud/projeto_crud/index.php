
<?php
require 'includes/conexao.php';
require 'includes/funcoes.php';
if (!usuario_logado()) { header('Location: login.php'); exit; }
include'includes/header.php';
?>
<div class="p-4 bg-light rounded-3">
  <h1 class="h3">Bem-vindo(a), <?= htmlspecialchars($_SESSION['usuario']['nome']) ?>!</h1>
  <p class="mb-0">Esta é a área administrativa do sistema. Use o menu para gerenciar usuários.</p>
</div>
<div class="mt-4">
  <a class="btn btn-outline-primary" href="listar.php">Gerenciar usuários</a>
</div>

