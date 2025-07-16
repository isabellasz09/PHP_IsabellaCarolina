<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $numero = 1;
        $i = 0;
        while($numero<=10){
     
            while($i <= 10){
                    $resultado = ($numero * $i);
                    echo "$numero x $i = $resultado <br>"; 
                    $i++;
                    }

        $numero++;
        $i = 1;
        echo"<br>";
        }
?>
</body>
</html>