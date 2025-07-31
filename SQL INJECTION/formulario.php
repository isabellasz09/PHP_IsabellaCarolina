<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loginInseguro</title>
</head>
<body>
    <h2>Formulario Inseguro</h2>
    <form action="loginInseguro.php" method="POST">
        <input type="text" name="nome" placeholder="Digite seu nome">
        <button type="submit">Entrar</button>
    </form>

    <h2>Formulario Seguro</h2>
    <form action="loginSeguro.php" method="POST">
        <input type="text" name="nome" placeholder="Digite seu nome">
        <button type="submit">Entrar</button>
    </form>
</body>
</html>