<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cliente</title>
    <link rel="stylessheet" href="style.css">
</head>
<body>
    <h2>Excluir Cliente</h2>
    <form action = "processarDelecao.php" method="POST">
        <LAbel for="id">ID do Cliente</LAbel>
        <input type="number" id="id" name="id" required>

        <button type="submit">Excluir Cliente</button>
</form>
</body>
</html>