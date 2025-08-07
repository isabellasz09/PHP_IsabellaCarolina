<?php
require('conecta.php');

//obtem o id via get garantindo que seja um numero inteiro
$id_imagem = isset($_GET['id'])? intval($_GET['id']):0;

//verifica se o id é valido(maior que zero)
if($id_imagem >0){
    //criar uma query segura usando o prepared statement
    $queryExclusao = "DELETE FROM tabela_imagens WHERE codigo = ?";

    //prepare a Query
    $stmt = $conexao->prepare($queryExclusao);
    $stmt->bind_param("i",$id_imagem); //define o id como um inteiro

    //executa a excluisao
    if($stmt->execute()){
        echo "Imagem excluída com sucesso!";

    }else{
        die("Erro ao excluir a imagem: ".$stmt->error);
    }
    //fecha conexao
    $stmt->close();

}else{
    echo "ID inválido";
}

//redireciona para index php e garante que o script pare
header("Location: index.php");
exit();
?>