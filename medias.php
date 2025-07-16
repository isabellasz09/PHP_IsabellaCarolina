<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $media = 3;

    $aprovado = ($media >= 7);
    if ($aprovado)
    {
        echo "aprovado";
    }

    $reprovado = ($media < 7 & $media > 3);
    if ($reprovado)
    {
        echo "reprovado";
    }

    $exame = ($media <= 3);
    if ($exame)
    {
        echo "exame";
    }
    ?>
</body>
</html>