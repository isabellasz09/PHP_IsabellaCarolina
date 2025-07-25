<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="forms" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesCliente.css">
    <title>Formulario Cliente</title>
    <script src="formulario_SA.js"></script>
</head>

<body class="tudo">
    <fieldset>
        <form action="backCliente.php" method="GET">
            <table>

                <tr>
                    <th rowspan="2">
                        </td><img src="img/LogoForneInjet.png" alt="LogoForneInjet" height="80" width=""></th>
                    <th class="titulo">Cadastro</th>
                </tr>
                <th class="titulo">Cliente</th>
                <tr>
                    <th></th>
                </tr>
                <th>Nome:</th>
                <th><input name= "cliente_nome" type="text" onkeypress=" mascara(this, nome)" maxlength="14"></th>
                <tr>
                    <th>Telefone:</th>
                    <th><input name= "cliente_telefone"type="text" onkeypress=" mascara(this, telefone)" maxlength="14"></th>
                </tr>
                <th>E-mail:</th>
                <th><input name= "cliente_email"type="text"></th>
                <tr>
                    <th>CNPJ:</th>
                    <th><input name= "cliente_CNPJ" type="text" onkeypress=" mascara(this, cnpj)" maxlength="20"></th>
                </tr>
                <th>Rua:</th>
                <th><input name= "cliente_rua" type="text"></th>
                <tr>
                    <th>Número:</th>
                    <th><input name="cliente_numero" type="text" onkeypress=" mascara(this, numero)" maxlength="14"></th>
                </tr>
                <th>Bairro:</th>
                <th><input name= "cliente_bairro" type="text" onkeypress=" mascara(this, bairro)" maxlength="14"></th>
                <tr>
                    <th>Cidade:</th>
                    <th><input name= "cliente_cidade" type="text" onkeypress=" mascara(this, cidade)" maxlength="14"></th>
                </tr>
                <th>Estado:</th>
                <th><input name= "cliente_estado" type="text" onkeypress=" mascara(this, estado)" maxlength="14"></th>
                <tr>
                    <th>CEP:</th>
                    <th><input name= "cliente_CEP" type="text" onkeypress="mascara(this,cep)" maxlength="10"></th>

                </tr>
            </table>
        </fieldset>
        <div>
            <tr>
                <td class="botao">
                    <input class="btn 1" type="submit" onclick="return valida" value="Enviar">
                    <input class="btn 2" type="button" value="Cancelar">
                </td>
            </tr>
        </div>
    </form>
    <br><br>
    <address>
        Isabella de Souza - Estudante - Tecnico - Desenvolvimento de Sistemas
    </address>
</body>

</html>