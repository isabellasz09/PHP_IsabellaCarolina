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

    try
        //conexao com banco usando PDO
        $pdo = new PDO("mysql:$host;dbname:$dbname,$username,")