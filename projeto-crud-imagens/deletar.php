<?php
include "includes/conexao.php";

if (!isset($_GET['id'])) {
    header('Location: ler.php');
    exit;
}
$id = (int) $_GET['id'];
$sql = "DELETE FROM funcionarios WHERE id=$id";

if ($conexao->query($sql) === TRUE) {
    header("Location: ler.php");
    exit;
} else {
    echo "Erro ao deletar: " . $conexao->error;
}
?>
