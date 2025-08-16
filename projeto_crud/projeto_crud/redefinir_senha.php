
<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
check_csrf();

$token = $_GET['token'] ?? '';
$erro = '';
$sucesso = '';

if (!$token) {
    http_response_code(400);
    die('Token ausente.');
}

$stmt = $conn->prepare('SELECT id, data_token FROM usuarios WHERE token_recuperacao = ? LIMIT 1');
$stmt->execute([$token]);
$user = $stmt->fetch();

if (!$user) {
    http_response_code(400);
    die('Token inválido.');
}

// verifica expiração (1 hora)
$expira = strtotime($user['data_token'] . ' +1 hour');
if (time() > $expira) {
    // Expirou: limpa token
    $conn->prepare('UPDATE usuarios SET token_recuperacao = NULL, data_token = NULL WHERE id = ?')->execute([$user['id']]);
    die('Token expirado. Solicite novamente a redefinição.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['senha'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (strlen($senha) < 6) {
        $erro = 'A senha deve ter ao menos 6 caracteres.';
    } elseif ($senha !== $confirm) {
        $erro = 'As senhas não coincidem.';
    } else {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('UPDATE usuarios SET senha = ?, token_recuperacao = NULL, data_token = NULL WHERE id = ?');
        $stmt->execute([$hash, $user['id']]);
        $sucesso = 'Senha redefinida com sucesso! Você já pode fazer login.';
    }
}

include 'includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-8 col-lg-6">
    <h1 class="mb-3">Redefinir senha</h1>
    <?php if ($erro): ?><div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
    <?php if ($sucesso): ?>
      <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
      <a class="btn btn-primary" href="login.php">Ir para o login</a>
    <?php else: ?>
      <form method="post">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <div class="mb-3">
          <label class="form-label">Nova senha</label>
          <input type="password" class="form-control" name="senha" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Confirmar senha</label>
          <input type="password" class="form-control" name="confirm" required>
        </div>
        <button type="submit" class="btn btn-primary">Redefinir</button>
      </form>
    <?php endif; ?>
  </div>
</div>

