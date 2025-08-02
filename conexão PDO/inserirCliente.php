<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylessheet" href="stylemenu.css">
    <link rel="stylessheet" href="stylebootstrap.css">

</head>
<body>
    <?php include ("dropdown.php");?> 

    <h2 class="titulo">Cadastro de Cliente</h2>
        <form>
            <div class="nome">
                <label for="exampleInputPassword1">Nome</label>
                <input type="password" class="form-control" id="exampleInputName1" required>
            </div>
            
            <div class="endereco">
                <label for="exampleInputPassword1">Endereço</label>
                <input type="text" class="form-control" id="exampleInputEndereço1" required>
            </div>

            <div class="senha">
                <label for="exampleInputPassword1">Senha</label>
                <input type="number" class="form-control" id="exampleInputSenha1" required>
            </div>
            
            <div class="email">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
</body>
</html>