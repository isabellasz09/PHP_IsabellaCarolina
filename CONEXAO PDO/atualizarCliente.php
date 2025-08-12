<?php
require_once 'conexao.php';
$conexao = conectarBanco();

$idCliente = $_GET['id'] ?? null;
$cliente = null;
$msgErro = "";

function buscarClientePorId($idCliente, $conexao) {
    $stmt = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE id_cliente = :id");
    $stmt->bindParam(":id", $idCliente, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

if ($idCliente && is_numeric($idCliente)) {
    $cliente = buscarClientePorId($idCliente, $conexao);
    if (!$cliente) {
        $msgErro = "Erro: Cliente não encontrado!";
    }
} else {
    $msgErro = "Digite o ID do cliente para buscar os dados.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function habilitarEdicao(campo) {
            document.getElementById(campo).removeAttribute("readonly");
        }
    </script>
</head>
<body class="bg-light">
<?php include("dropdown.php"); ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Atualizar Cliente</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($msgErro): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($msgErro) ?></div>
                            <form action="atualizarCliente.php" method="GET">
                                <div class="mb-3">
                                    <label for="id" class="form-label">ID do Cliente:</label>
                                    <input type="number" name="id" id="id" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </form>
                        <?php else: ?>
                            <form action="processarAtualizacao.php" method="POST">
                                <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($cliente['id_cliente']) ?>">

                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" name="nome" id="nome" class="form-control" 
                                           value="<?= htmlspecialchars($cliente['nome']) ?>" 
                                           readonly onclick="habilitarEdicao('nome')">
                                </div>

                                <div class="mb-3">
                                    <label for="endereco" class="form-label">Endereço</label>
                                    <input type="text" name="endereco" id="endereco" class="form-control"
                                           value="<?= htmlspecialchars($cliente['endereco']) ?>"
                                           readonly onclick="habilitarEdicao('endereco')">
                                </div>

                                <div class="mb-3">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="text" name="telefone" id="telefone" class="form-control"
                                           value="<?= htmlspecialchars($cliente['telefone']) ?>"
                                           readonly onclick="habilitarEdicao('telefone')">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                           value="<?= htmlspecialchars($cliente['email']) ?>"
                                           readonly onclick="habilitarEdicao('email')">
                                </div>

                                <button type="submit" class="btn btn-success w-100">Atualizar Cliente</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
