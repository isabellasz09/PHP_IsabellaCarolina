<?php include "includes/cabecalho.php"; ?>
<?php include "includes/conexao.php"; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $conexao->real_escape_string($_POST['nome']);
    $cargo = $conexao->real_escape_string($_POST['cargo']);
    $foto = null;
    if (!empty($_FILES['foto']['tmp_name'])) {
        $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
    }

    $sql = "INSERT INTO funcionarios (nome, cargo, foto) VALUES ('$nome', '$cargo', '$foto')";

    if ($conexao->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Funcionário cadastrado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $conexao->error . "</div>";
    }
}
?>

<h2>Cadastrar Funcionário</h2>
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Cargo:</label>
        <input type="text" name="cargo" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Foto:</label>
        <input type="file" name="foto" class="form-control-file" required>
    </div>
    <button type="submit" class="btn btn-warning">Cadastrar</button>
</form>

</div>
</body>
</html>
