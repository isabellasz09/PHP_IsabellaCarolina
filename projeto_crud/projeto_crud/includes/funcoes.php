
<?php
if (session_status() === PHP_SESSION_NONE) session_start();

define('DEBUG_EMAIL', true);

function sanitize($value) {
    if (is_array($value)) return array_map('sanitize', $value);
    return trim(filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
}

function email_valido($email) {
    return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
}

function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function check_csrf() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        if (!$token || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            http_response_code(400);
            die('Token CSRF inválido.');
        }
    }
}

function usuario_logado() {
    return !empty($_SESSION['usuario']);
}
function exigir_login() {
    if (!usuario_logado()) {
        header('Location: login.php'); 
        exit;
    }
}

function enviar_email_recuperacao($para, $link) {
    $assunto = 'Redefinição de Senha';
    $mensagem = "Olá,\n\nRecebemos uma solicitação para redefinir sua senha. Clique no link abaixo:\n$link\n\nSe você não solicitou, ignore este e-mail.";
    $cabecalhos = 'From: noreply@exemplo.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
    @mail($para, $assunto, $mensagem, $cabecalhos);

    if (DEBUG_EMAIL) {
        $_SESSION['ultimo_link_envio'] = $link; 
    }
}

function redirect($path) {
    header("Location: $path");
    exit;
}
