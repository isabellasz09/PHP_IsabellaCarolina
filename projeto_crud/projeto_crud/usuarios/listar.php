
<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
if (!usuario_logado()) { header('Location: login.php'); exit; }

$stmt = $conn->query('SELECT id, nome, email, criado_em FROM usuarios ORDER BY id DESC');
$usuarios = $stmt->fetchAll();

include 'includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3">Usuários</h1>
  <a class="btn btn-primary" href="cadastrar.php">Cadastrar</a>
</div>

<div class="table-responsive">
  <table class="table table-striped align-middle">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Criado em</th>
        <th class="text-end">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($usuarios as $u): ?>
        <tr>
          <td><?= (int)$u['id'] ?></td>
          <td><?= htmlspecialchars($u['nome']) ?></td>
          <td><?= htmlspecialchars($u['email']) ?></td>
          <td><?= htmlspecialchars($u['criado_em']) ?></td>
          <td class="text-end">
            <a class="btn btn-sm btn-outline-secondary" href="editar.php?id=<?= (int)$u['id'] ?>">Editar</a>
            <a class="btn btn-sm btn-outline-danger" href="excluir.php?id=<?= (int)$u['id'] ?>">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
