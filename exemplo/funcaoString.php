<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $vogais = array("a","e","i","o","u","A","E","I","O","U");
        echo "Hello World of PHP<br/>";
        $cons = str_replace($vogais,"","Hello World of PHP");
        echo "Consoantes:".$cons,"<br/>";
        //012345678901
        $test = "Hello World <br>";
        print "Posição de letra 'o' :";
        print strpos($test, "o")."<br/>";
        print "Posição de letra 'o' após 5 :";
        print strpos($test, "o",5)."<hr/>";
        $massage = "troca letra uma a uma";
        echo $massage."<br/>";
        $new_message = strtr($massage, 'abcdef', '123456');
        echo "Criptogrando: ".$new_message."<br/>";
        $new_message = strtr($massage, '123456', 'abcdef');
        echo "Descriptorafando: ".$new_message."<br/>";

    ?>
</body>
</html>