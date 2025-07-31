<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "empresa_teste";

$conexao = new mysqli($servidor,$usuario,$senha,$banco);
if($conexao->connect_error){
    die("Erro de conexão: ".$conexao->connect_error);

}

$nome =$_POST["nome"];

$stmt = $conexao->prepare("SELECT *FROM cliente_teste WHERE nome = ?");
$stmt->bind_param("s", $nome);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows>0){
    header("Location: area_restrita.php");
    exit();

}else{
    echo "Nome não encontrado.";
}
$stmt->close();
$conexao->close();
?>