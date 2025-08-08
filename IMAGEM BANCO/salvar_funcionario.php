<?php
//funcao para dimensionar a imagem
function redimencionarImagem($imagem, $largura, $altura){
    //obtem as dimensoes originais da imagem getimagesize() retorna a largura e a altura de uma altura de uma imagem
    list($larguraOriginal,$alturaOriginal) = getimagesize
    ($imagem);

    $novaImagem = imagecreatetruecolor($largura,$altura);

    //carrega a imagem original (jpeg) a partir do arquivo imagecreatefromjpeg() cria a imagem php a partir de um jpeg
    $imagemOriginal = imagecreatefromjpeg($imagem);

    //copia e redmenciona a imagem original para a nova
    //imagecopyresampled() -- copia e redimensionamento e suavizaçao
    imagecopyresampled($novaImagem, $imagemOriginal,0,0,0,0,$largura,$altura,$larguraOriginal,$alturaOriginal);
    
    //inicia um buffer para guardar a imagem como texto binario
    //ob_start() -- inicia o "output buffering" guardando a saida 
    ob_start();
    //imagejpeg() envia a imagem para o output (que vai pro buffer)
    imagejpeg($novaImagem);

    //ob_get_clean() -- pegar o conteudo do buffer e apaga
    $dadosImagem = ob_get_clean();

    //libera memoria usada
    //imagedestroy() -- limpa a memoria
    imagedestroy($novaImagem);
    imagedestroy($imagemOriginal);

    //retorna a imagem redimencionada em formato binario
    return $dadosImagem;

}

    //configuracao do banco de dados
    $host = 'localhost';
    $dbname = 'armazena_imagem';
    $username = 'root';
    $password = '';

    try{
        //conexao com banco usando PDO
        $pdo = new PDO("mysql:host=$host;dbname:$dbname",$username,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERMODE_EXCEPTION);

        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_FILES['foto'])){

            if($_FILES['foto']['error']== 0){
                $nome = $_POST['nome'];
                $telefone = $_POST['telefone'];
                $nomeFoto = $_FILES['foto']['name']; //pega o nome original do arquivo
                $tipoFoto = $_FILES['foto']['type']; //pega o tipo mime da imagem

            //redimenciona a imagem
            //o codigo abaixo cuja variavel é tmp_name é o caminho temporario do arquivo
            $foto = redimencionarImagem($_FILES['foto']['tmp_name'],300,400);
            
            //insere no banco de dados usando o sql prepared
            $sql = "INSERT INTO funcionarios (nome,telefone,nome_foto,tipo_foto,foto)
            VALUES (:nome,:telefone,:nome_foto,:tipo_foto,:foto)";
            $stmt = $pdo->prepare($sql); //responsavel por preparar a query para evitar o ataque de sql injection
            $stmt->bindParam(':nome',$nome); //liga os parametros ás variaveis
            $stmt->bindParam(':telefone',$telefone); //liga os parametros ás variaveis
            $stmt->bindParam(':nome_foto',$nomeFoto); //liga os parametros ás variaveis
            $stmt->bindParam(':tipo_foto',$tipoFoto); //liga os parametros ás variaveis
            $stmt->bindParam(':foto',$foto,PDO::PARAM_LOB); //liga os parametros ás variaveis

            }
        }
    }
    ?>