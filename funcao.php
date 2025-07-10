<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $nome = "stefanie hatcher";
        $length = strlen($nome);
        $cmp = strcmp ($nome , "brian le");
        $index = strpos($nome, "e");
        $first = substr($nome, 9, 5);
        $nome = strtoupper($nome);
        
        echo ("<br>");
        print ($length);
        echo ("<br>");
        print ($cmp);
        echo ("<br>");
        print ($index);
        echo ("<br>");
        print ($first);
        echo ("<br>");
        print ($nome);
        ?>

</body>
</html>