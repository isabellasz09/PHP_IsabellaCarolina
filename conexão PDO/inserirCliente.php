<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylessheet" href="style.css">
</head>
<body>
    <h2>Cadastro de Cliente</h2>
    <form action="processarInsercao.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <p>
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>
        <br>
        <p>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required>
        <br>
        <p>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <p>
        <button type="submit">Cadastrar Cliente</button>
    </form>
</body>
</html>