
<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
check_csrf();

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email'] ?? '');

    if (!email_valido($email)) {
        $mensagem = 'Informe um e-mail válido.';
    } else {
        $stmt = $conn->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            $token = bin2hex(random_bytes(32));
            $data_token = date('Y-m-d H:i:s');
            $stmt = $conn->prepare('UPDATE usuarios SET token_recuperacao = ?, data_token = ? WHERE id = ?');
            $stmt->execute([$token, $data_token, $user['id']]);

            $link = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost') . "redefinir_senha.php?token=$token";
            enviar_email_recuperacao($email, $link);
            $mensagem = 'Se o e-mail existir, um link de redefinição será enviado.';
        } else {
            $mensagem = 'Se o e-mail existir, um link de redefinição será enviado.';
        }
    }
}

include 'includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-8 col-lg-6">
    <h1 class="mb-3">Esqueci minha senha</h1>
    <?php if ($mensagem): ?><div class="alert alert-info"><?= htmlspecialchars($mensagem) ?></div><?php endif; ?>
    <form method="post">
      <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
      <div class="mb-3">
        <label class="form-label">Seu e-mail</label>
        <input type="email" class="form-control" name="email" required>
        <small class="help">Você receberá um link para redefinir sua senha (em modo DEV, o link aparece no rodapé).</small>
      </div>
      <button type="submit" class="btn btn-primary">Enviar link</button>
      <a class="btn btn-link" href="login.php">Voltar ao login</a>
    </form>
  </div>
</div>

