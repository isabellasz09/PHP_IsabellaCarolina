
<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
if (!usuario_logado()) { header('Location: login.php'); exit; }

$id = (int)($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['confirm'] ?? '') === 'sim') {
        $stmt = $conn->prepare('DELETE FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
    }
    header('Location: listar.php');
    exit;
}

$stmt = $conn->prepare('SELECT id, nome, email FROM usuarios WHERE id = ?');
$stmt->execute([$id]);
$user = $stmt->fetch();
if (!$user) { http_response_code(404); die('Usuário não encontrado.'); }

include 'includes/header.php';
?>
<h1 class="mb-3">Excluir usuário</h1>
<div class="alert alert-warning">
  Tem certeza que deseja excluir o usuário <strong><?= htmlspecialchars($user['nome']) ?></strong> (<?= htmlspecialchars($user['email']) ?>)?
</div>
<form method="post" class="d-flex gap-2">
  <button type="submit" name="confirm" value="sim" class="btn btn-danger">Sim, excluir</button>
  <a class="btn btn-secondary" href="listar.php">Cancelar</a>
</form>

