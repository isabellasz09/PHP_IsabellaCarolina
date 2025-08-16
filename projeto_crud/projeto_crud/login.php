
<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
check_csrf();

if (usuario_logado()) {
    redirect('index.php');
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!email_valido($email) || empty($senha)) {
        $erro = 'Credenciais inválidas.';
    } else {
        $stmt = $conn->prepare('SELECT id, nome, email, senha FROM usuarios WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['usuario'] = [
                'id' => $user['id'],
                'nome' => $user['nome'],
                'email' => $user['email']
            ];
            redirect('index.php');
        } else {
            $erro = 'E-mail ou senha incorretos.';
        }
    }
}
include 'includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-8 col-lg-6">
    <h1 class="mb-3">Entrar</h1>
    <?php if ($erro): ?><div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
    <form method="post" novalidate>
      <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password" class="form-control" name="senha" required>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">Entrar</button>
        <a href="esqueci_senha.php">Esqueci minha senha</a>
      </div>
    </form>
  </div>
</div>

