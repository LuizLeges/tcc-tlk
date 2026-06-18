<?php

//FEITO

$msg = '';
if($_POST){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    include "conecta.php";
    $sql = "INSERT INTO administrador (usuario, senha, nome) VALUES ('$email', '$senha', '$nome')";
    mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn)>0){
        $msg = "<h3> Cadastro efetuado com sucesso. </h3>";
    } else {
        $msg = "<h3> Falha ao cadastrar. </h3>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main-wrapper">    <h1> Cadastro de ADMINS </h1>
    <?php echo $msg; ?></div>

    <form action="" method="POST">
        Nome: <br>
        <input type="text" name="nome" required/> <br> <br>
        Usuário: <br>
        <input type="text" name="email" placeholder="seu@email.com" required/> <br> <br>
        Senha: <br>
        <input type="text" name="senha" required/> <br> <br>
        <input type="submit" value="Cadastrar"/>
    </form>
<hr> 

</body>
</html>