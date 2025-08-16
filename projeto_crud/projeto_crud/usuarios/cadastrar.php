<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
check_csrf();
if (!usuario_logado()) { header('Location: login.php'); exit; }

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitize($_POST['nome'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!$nome || !email_valido($email) || strlen($senha) < 6) {
        $erro = 'Preencha os campos corretamente. Senha com no mínimo 6 caracteres.';
    } else {
        $stmt = $conn->prepare('SELECT id FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $erro = 'E-mail já cadastrado.';
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
            $stmt->execute([$nome, $email, $hash]);
            header('Location: listar.php');
            exit;
        }
    }
}

include 'includes/header.php';
?>
<h1 class="mb-3">Cadastrar usuário</h1>
<?php if ($erro): ?><div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<form method="post">
  <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
  <div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" class="form-control" name="nome" required>
  </div>
  <div class="mb-3">
    <label class="form-label">E-mail</label>
    <input type="email" class="form-control" name="email" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Senha</label>
    <input type="password" class="form-control" name="senha" required>
    <small class="help">Mínimo de 6 caracteres.</small>
  </div>
  <button type="submit" class="btn btn-primary">Salvar</button>
  <a class="btn btn-link" href="listar.php">Cancelar</a>
</form>

