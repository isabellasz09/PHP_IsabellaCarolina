<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //Função usada para definir fuso horário padrão date_defalt_timezone_set('America/Los_Angeles');
        //Manipulando HTML E PHP 
        $data_hoje = date ("d/m/y", time());
    ?>

    <p align="center"> Hoje é dia <?php echo $data_hoje; ?>
</p>
</body>
</html>