<?php 
require_once "conexao.php";
$conexao = conectarBanco();

$buscar = $_GET['buscar'] ?? "";

if (!$buscar) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pesquisar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("dropdown.php"); ?>
    <div class="container mt-5">
        <h3>Pesquisar Cliente</h3>
        <form action="pesquisarCliente.php" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Digite o ID ou Nome" required>
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php
    exit;
}

if (is_numeric($buscar)) {
    $stml = $conexao->prepare("SELECT * FROM cliente WHERE id_cliente = ?");
    $stml->execute([$buscar]);
} else {
    $stml = $conexao->prepare("SELECT * FROM cliente WHERE nome LIKE ?");
    $stml->execute(["%$buscar%"]);
}
$resultado = $stml->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Pesquisa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("dropdown.php"); ?>
    <div class="container mt-5">
        <h3>Resultado da Pesquisa</h3>
        <table class="table table-striped table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $cliente): ?>
                <tr>
                    <td><?= htmlspecialchars($cliente["id_cliente"]) ?></td>
                    <td><?= htmlspecialchars($cliente["nome"]) ?></td>
                    <td><?= htmlspecialchars($cliente["endereco"]) ?></td>
                    <td><?= htmlspecialchars($cliente["telefone"]) ?></td>
                    <td><?= htmlspecialchars($cliente["email"]) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
