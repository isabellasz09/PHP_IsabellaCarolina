<?php
//INCLUI O ARQUIVO DE CONEXAO COM O BANCO DE DADOS
require_once ('conecta.php');

//CRIA A CONSULTA sql PARA SELECIONAR OS DADOS PRINCIPAIS (sem coluna imagem)
$querySelecao="SELECT codigo, evento, descricao, nome_imagem,tamanho_imagem FROM tabela_imagens";
$resultado = mysqli_query($conexao,$querySelecao);

if(!$resultado){
    die("Erro na consulta: ".mysqli_error($conexao));

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armazenando Imagens no BD MySQL</title>
</head>
<body>
    <h2>Selecione um novo arquivo de imagem</h2>
    <form enctype="multipart/form-data" action="upload.php" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="999999999">
        <input type="text" name="evento" placeholder="Nome do Evento">
        <input type="text" name="descricao" placeholder="Descrição">
        <input type="file" name="imagem">
        <input type="submit" value="Salvar">
        </form>

    <table border="1">
        <tr>
            <td align="center">Codigo</td>
            <td align="center">Evento</td>
            <td align="center">Descrição</td>
            <td align="center">Nome da Imagem</td>
            <td align="center">Tamanho</td>
            <td align="center">Vizualizar Imagem</td>
            <td align="center">Excluir imagem</td>
        </tr>
    
    <?php
        while($arquivos = mysqli_fetch_array($resultado)){?>
            <tr>
            <td align="center"><?php echo $arquivos['codigo'];?></td>
            <td align="center"><?php echo $arquivos['evento'];?>Evento</td>
            <td align="center"><?php echo $arquivos['descricao'];?>Descrição</td>
            <td align="center"><?php echo $arquivos['nome_imagem'];?>Nome da Imagem</td>
            <td align="center"><?php echo $arquivos['tamanho_imagem'];?>Tamanho</td>
            <td align="center"><a href="ver_imagens.php?id=<?php" echo $arquivos['codigo'];"?>">Ver Imangens</a></td>
            <td align="center"><a href="excluir_imagem.php?id=<?php"echo $arquivos['codigo'];"?>">Excluir Imagem</a></td>
        </tr>
        <?php }?>
    </table> 
   
</body>
</html>