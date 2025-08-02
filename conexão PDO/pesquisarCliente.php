<?php
require_once'conexao.php';
$conexao= conectarBanco();

$busca = $_GET['busca']?? "";

if(!$busca){
    ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylessheet" href="stylepesquisa.css">
    
    <form class="form-inline">
  <div class="form-group mb-2">
    <label for="staticEmail2" class="sr-only">Email</label>
    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@exemplo.com">
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputPassword2" class="sr-only">Senha</label>
    <input type="password" class="form-control" id="inputPassword2" placeholder="Senha">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Confirmar identidade</button>
</form>
</form>
<?php
exit;
}

if(is_numeric($busca)){
    $stmt=$conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE id_cliente = :id");
    $stmt->bindParam(":id", $busca, PDO::PARAM_INT);
}else {
    $stmt=$conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE nome LIKE :nome");
    $buscaNome = "%$busca%";
    $stmt->bindParam(":nome",$buscaNome, PDO::PARAM_STR);

}
$stmt->execute();
$cliente =$stmt->fetchAll();

if(!$clientes){
    die("Erro: Nenhum cliente encontrado.");
}
?>
<table border="1">
    <tr>
        <th>ID</th> 
        <th>Nome</th> 
        <th>Endereço</th> 
        <th>Telefone</th> 
        <th>E-mail</th> 
        <th>Ação</th> 
</tr>

    <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?=htmlspecialchars($cliente["id_cliente"])?></td>
                <td><?=htmlspecialchars($cliente["nome"])?></td>
                <td><?=htmlspecialchars($cliente["endereco"])?></td>
                <td><?=htmlspecialchars($cliente["telefone"])?></td>
                <td><?=htmlspecialchars($cliente["email"])?></td>
                <td>
                    <a href="atualizarCliente.php?id=<?=$cliente['id_cliente']?>">Editar</a> 
                </td>
                <td>
                    <a href="deletarCliente.php?id=<?=$cliente['id_cliente']?>">Excluir</a> 
                </td>
                <td>
                    <a href="pesquisarCliente.php?id=<?=$cliente['id_cliente']?>">Pesquisar</a> 
                </td>
            </tr>
            <?php endforeach;?>
        </table>
