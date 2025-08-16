
<?php
require_once 'includes/conexao.php';
require_once  'includes/funcoes.php';
check_csrf();
if (!usuario_logado()) { header('Location: login.php'); exit; }

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare('SELECT id, nome, email FROM usuarios WHERE id = ?');
$stmt->execute([$id]);
$user = $stmt->fetch();
if (!$user) { http_response_code(404); die('Usuário não encontrado.'); }

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitize($_POST['nome'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!$nome || !email_valido($email)) {
        $erro = 'Preencha os campos corretamente.';
    } else {
        $stmt = $conn->prepare('SELECT id FROM usuarios WHERE email = ? AND id <> ?');
        $stmt->execute([$email, $id]);
        if ($stmt->fetch()) {
            $erro = 'E-mail já cadastrado para outro usuário.';
        } else {
            if ($senha) {
                if (strlen($senha) < 6) {
                    $erro = 'Senha deve ter ao menos 6 caracteres.';
                } else {
                    $hash = password_hash($senha, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare('UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?');
                    $stmt->execute([$nome, $email, $hash, $id]);
                }
            } else {
                $stmt = $conn->prepare('UPDATE usuarios SET nome = ?, email = ? WHERE id = ?');
                $stmt->execute([$nome, $email, $id]);
            }
            if (!$erro) { header('Location: listar.php'); exit; }
        }
    }
}

require_once 'includes/header.php';
?>
<h1 class="mb-3">Editar usuário</h1>
<?php if ($erro): ?><div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<form method="post">
  <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
  <div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($user['nome']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">E-mail</label>
    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Nova senha (opcional)</label>
    <input type="password" class="form-control" name="senha" placeholder="Deixe em branco para manter">
  </div>
  <button type="submit" class="btn btn-primary">Salvar alterações</button>
  <a class="btn btn-link" href="listar.php">Cancelar</a>
</form>

