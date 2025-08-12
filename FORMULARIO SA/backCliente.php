<?php session_start() ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>

<?php
   
    $formcli = array();
    if (
        isset($_GET["cliente_nome"]) && isset($_GET["cliente_CNPJ"]) && isset($_GET["cliente_telefone"])
        && isset($_GET["cliente_email"])&& isset($_GET["cliente_CEP"]) && isset($_GET["cliente_estado"])
        && isset($_GET["cliente_cidade"])&& isset($_GET["cliente_bairro"]) 
        && isset($_GET["cliente_rua"]) && isset($_GET["cliente_numero"])
    ) {
        $_SESSION['formcli'][] = $_GET["cliente_nome"];
        $_SESSION['formcli'][] = $_GET["cliente_CNPJ"];
        $_SESSION['formcli'][] = $_GET["cliente_telefone"];
        $_SESSION['formcli'][] = $_GET["cliente_email"];
        $_SESSION['formcli'][] = $_GET["cliente_CEP"];
        $_SESSION['formcli'][] = $_GET["cliente_estado"];
        $_SESSION['formcli'][] = $_GET["cliente_cidade"];
        $_SESSION['formcli'][] = $_GET["cliente_bairro"];
    }
    $formcli = array();
    if (isset($_SESSION['formcli'])) {

        $formcli = $_SESSION['formcli'];


    }

?>

    <table>
        <tr>
            <th>
                <h1>INFORMAÇÔES DO CLIENTE</h1>
            </th>
        </tr>
        <?php foreach ($formcli as $echoforn)
        : ?>
            <tr>
                <td><?php echo $echoforn; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
