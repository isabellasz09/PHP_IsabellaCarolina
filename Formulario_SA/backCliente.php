<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo "Nome: ".$_GET["cliente_nome"];
        echo "Telefone: ".$_GET["cliente_telefone"];
        echo "Email: ".$_GET["cliente_email"];
        echo "CNPJ: ".$_GET["cliente_CNPJ"];
        echo "Rua: ".$_GET["cliente_rua"];
        echo "Numero: ".$_GET["cliente_numero"];
        echo "Bairro: ".$_GET["cliente_bairro"];
        echo "Cidade: ".$_GET["cliente_cidade"];
        echo "Estado: ".$_GET["cliente_estado"];
        echo "CEP: ".$_GET["cliente_CEP"];
    ?>
</body>
</html>