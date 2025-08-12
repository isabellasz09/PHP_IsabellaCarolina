<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saida do Console</title>
</head>
<body>
    <?php
        print "teste<br>";
        print "Olá, Mundo<br>";
        print "Escape 'chars' são os MESMOS como em C<br>";
        print "Você pode ter quebras de linhas em uma string. ";
        print "Uma string pode usar 'aspas-duplas'. Isso é muito legal!<br>";
        print "Ainda pode-se usar aspas simples dessa forma It\'s cool!<br>";

        echo "texto<br>";
        echo "Olá, Mundo<br>";
        echo "Isso abrange
        várias linhas. As novas linhas serão
        saída também. <br>";
        echo "Isso abrange\nmultiplas linhas. A nova linha será <br>a saída também. ";
        echo "Caracteres Escaping são feitos \"como esse\"."
    ?>
</body>
</html>