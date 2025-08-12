<?php include "includes/cabecalho.php"; ?>
<?php include "includes/conexao.php"; ?>

<h2>Lista de Funcionários</h2>

<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Cargo</th>
        <th>Foto</th>
        <th>Ações</th>
    </tr>

<?php
$sql = "SELECT * FROM funcionarios";
$resultado = $conexao->query($sql);

if ($resultado && $resultado->num_rows > 0):
    while($row = $resultado->fetch_assoc()):
?>
    <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['nome']) ?></td>
        <td><?= htmlspecialchars($row['cargo']) ?></td>
        <td>
            <?php if (!empty($row['foto'])): ?>
                <img src="data:image/jpeg;base64,<?= base64_encode($row['foto']) ?>" width="80" alt="Foto do funcionário">
            <?php else: ?>
                Sem foto
            <?php endif; ?>
        </td>
        <td>
            <a href="atualizar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
            <a href="deletar.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
               onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
        </td>
    </tr>
<?php
    endwhile;
else:
?>
    <tr><td colspan="5">Nenhum funcionário cadastrado</td></tr>
<?php
endif;
?>

</table>

</div>
</body>
</html>
