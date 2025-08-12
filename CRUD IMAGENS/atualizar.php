<?php include "includes/cabecalho.php"; ?>
<?php include "includes/conexao.php"; ?>

<?php
if (!isset($_GET['id'])) {
    header('Location: ler.php');
    exit;
}
$id = (int) $_GET['id'];
$sql = "SELECT * FROM funcionarios WHERE id=$id";
$resultado = $conexao->query($sql);
if ($resultado->num_rows == 0) {
    echo '<div class="alert alert-warning">Funcionário não encontrado.</div>';
    echo '</div></body></html>';
    exit;
}
$func = $resultado->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $conexao->real_escape_string($_POST['nome']);
    $cargo = $conexao->real_escape_string($_POST['cargo']);

    if (!empty($_FILES['foto']['tmp_name'])) {
        $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
        $sql = "UPDATE funcionarios SET nome='$nome', cargo='$cargo', foto='$foto' WHERE id=$id";
    } else {
        $sql = "UPDATE funcionarios SET nome='$nome', cargo='$cargo' WHERE id=$id";
    }

    if ($conexao->query($sql) === TRUE) {
        header("Location: ler.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $conexao->error . "</div>";
    }
}
?>

<h2>Editar Funcionário</h2>
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($func['nome']); ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Cargo:</label>
        <input type="text" name="cargo" value="<?php echo htmlspecialchars($func['cargo']); ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Foto Atual:</label><br>
        <?php if (!empty($func['foto'])): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($func['foto']); ?>" width="100">
        <?php else: ?>
            <p>Sem foto</p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label>Alterar Foto:</label>
        <input type="file" name="foto" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-warning">Salvar Alterações</button>
</form>

</div>
</body>
</html>
