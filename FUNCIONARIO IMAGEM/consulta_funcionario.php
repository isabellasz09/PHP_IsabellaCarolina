<?php
 $host = 'localhost';
 $dbname = 'armazena_imagem';
 $username = 'root';     
 $password = '';

 try{
    //conexao com banco usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    //recupera todos os funcionarios do banco de dados
    $sql = "SELECT id, nome FROM funcionarios";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC); //busca todos os resultados como uma matriz associativa

    //verifica se foi solicitado a excluisao de um funcionario
    if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['excluir_id'])){
        $excluir_id = $_POST['excluir_id'];
        $sql_excluir = "DELETE FROM funcionarios WHERE id=:id";
        $stmt_excluir = $pdo->prepare($sql_excluir);
        $stmt_excluir->bindParam(':id' ,$excluir_id,PDO::PARAM_INT);
        $stmt_excluir->execute();

        ///redireciona para evitar reenvio do formulario
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}catch(PDOExeption $e){
    echo 'Erro: '.$e->getMenssage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>consulta funcionario</title>
</head>
<body>
    <h1>Consulta de Funcionario</h1>

    <ul>
        <?php foreach($funcionarios as $funcionario):?>
            <li>
                <!-- codigo abaixo cria link para vizualizar detalhes do funcionario -->
                <a href="vizualizar_funcionario.php? id=<?= $funcionario['id']?>">
                <?=htmlspecialchars($funcionario['nome'])?>    
                </a>
                <!-- formulario para excluir funcionario -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="excluir_id" value="<?=$funcionario['id']?>">
                    <button type="submit">Excluir</button>
                </form>
            </li>
            <?php endforeach; ?>

    </ul>
</body>
</html>