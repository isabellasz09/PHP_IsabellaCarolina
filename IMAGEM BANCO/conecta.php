<?php
//DEFINIÇÃO DAS CREDENCIAIS DE CONEXAO

$servername="localhost";
$username="root";
$password="";
$dbname="armazena_imagem";

//CRIANDO A CONEXÃO MYSQLI
$conexao= new mysqli($servername, $username, $password, $dbname);
// VERIFICANDO DE HOUVE ERRO NA CONEXÃO 
if($conexao->connect_error){
    die("Falha na conexão: " .$conexao->connect_error);

}