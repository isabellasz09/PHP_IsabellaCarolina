<?php
 $host = 'localhost';
 $dbname = 'armazena_imagem';
 $username = 'root';     
 $password = '';

try{
    //conexao com banco usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        //recupera todos os funcionarios do banco de dados
        $sql = "SELECT nome, telefone, tipo_foto, foto FROM funcionarios WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt ->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount()>0){
            $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['excluir_id'])){
                $excluir_id = $_POST['excluir_id'];
                $sql_excluir = "DELETE FROM funcionarios WHERE id=:id";
                $stmt_excluir = $pdo->prepare($sql_excluir);
                $stmt_excluir->bindParam(':id',$excluir_id, PDO::PARAM_INT);
                
                header("Localition: consulta_funcionario.php");
                exit();
            }
            ?>
            <!DOCTYPE html>
            <html lang="pt_br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Vizualizar Funcionario</title>
            </head>
            <body>
                <h1>Dados do cliente</h1>
                <p>Nome: <?=htmlspecialchars($funcionario['nome'])?></p>
                <p>Telefone: <?=htmlspecialchars($funcionario['telefone'])?></p>
                <p>Foto:</p>
                <img src="data: <?=$funcionario['tipo_foto']?>;base64,<?=base64_encode($funcionario['foto'])?> " alt= "Foto do Funcionario">

                <form method="POST">
                    <input type="hidden" name="excluir_id" value="<?=$id?>">
                    <button type="submit">Excluir Funcionario</button>
                </form>
            </body>
            </html>
            <?php
    }else{
        echo "Funcionario não encontrado";

    }

    }else{
        echo "ID do funcionario nao foi fornecida";
    }
        
    }catch(PDOException $e){
        echo "Erro ".$e->getMessagem();
        }

  
?>
