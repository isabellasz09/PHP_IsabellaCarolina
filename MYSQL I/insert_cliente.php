<?php
require_once "conexao.php";

$conexao = conectadb();

$nome = "Isabella Souza";
$endereco = "Rua arquiteto george keller, 215";
$telefone = "(47) 9930-5747";
$email = "isabellacarolinadesouza17@gmail.com";

$stmt = $conexao->prepare("INSERT INTO cliente (nome, endereco, telefone, email) VALUES (?, ?, ?, ?)");


$stmt->bind_param("ssss",$nome,$endereco,$telefone,$email);


if ($stmt->execute()){
    echo "Cliente adicionado com sucessos!";
} else {
    echo "Erro ao adicionar cliente: ".$stmt->error;
}


$stmt->close();
$conexao->close();
   
?>


