<?php
include "conecta.php";
session_start();// descobri depois de um tempo que precisa chamar session_start() em todos arquivos
//de cara já verifica se tem sessão existente
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sqlAdmin = "SELECT * FROM administrador WHERE id= '$id'";
    $resAdmin = mysqli_query($conn, $sqlAdmin);
    $dadosAdmin = mysqli_fetch_assoc($resAdmin);
    $_SESSION["temaEscuro"] = $dadosAdmin["temaEscuro"];
} else {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
    <?php
    if ($_SESSION['temaEscuro']) {
        echo '<link rel="stylesheet" href="styleEscuro.css">';
    } else {
        echo '<link rel="stylesheet" href="style.css">';
    }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <header>
        <h1>S.I.G.C[...]</h1>
    </header>

    <ul class="sidenav">
        <li><a href="index.php?id=<?php echo $id; ?>"><i class="fa-solid fa-house"></i> Início</a></li>
        <hr><div style="padding: 10px;"><span style="font-size:20px;">Pessoas</span></div>
        <li><a href="listarAlunos.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
        <li><a href="listarResponsaveis.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user-tie"></i> Responsáveis</a></li>
        <li><a href="listarEstagiario.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user"></i> Estagiários</a></li>
        <hr><div style="padding: 10px;"><span style="font-size:20px;">Valores</span></div>
        <li><a href="listarMensalidades.php?id=<?php echo $id; ?>"><i class="fa-solid fa-piggy-bank"></i> Mensalidades</a></li>
        <li><a href="despesas.php?id=<?php echo $id; ?>"><i class="fa-solid fa-brazilian-real-sign"></i> Despesas</a></li>
        <hr><div style="padding: 10px;"><span style="font-size:20px;">Gestão</span></div>
        <li><a href="relatorios.php?id=<?php echo $id; ?>"><i class="fa-regular fa-clipboard"></i> Relatórios</a></li>
        <li><a href="listarAnotacoes.php?id=<?php echo $id; ?>"><i class="fa-solid fa-note-sticky"></i> Anotações</a></li>
        <hr><div style="padding: 10px;"><span style="font-size:20px;">Configurações</span></div>
        <li><a class="active" href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <hr>
        <li><a href="destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>

    <div class="main-wrapper">
        <div class="card">
            <div class="card-header"> Configurações </div>

            <div class="card-body">
                <div class="bloco-nota">
                    <h3>Nota:</h3>
                    <p>Essas configurações são alteradas apenas para você. Outro usuário não verá suas escolhas.</p>
                </div>
                <hr>    
                <label>
                    <p>Tema: <i class="fa-solid fa-sun" style="color: rgb(223, 208, 1);"></i> / <i class="fa-solid fa-moon" style="color: rgb(91, 175, 201);"></i></p>
                    <select name="tema">
                        <option value="claro"></i>Cor: VERDE / Tema: CLARO </option>                        
                        <option value="escuro">Cor: VERDE / Tema: ESCURO</option>                        
                        <option value="claroAzul">(INDISPONÍVEL: em breve) Cor: AZUL / Tema: CLARO</option>                        
                        <option value="escuroAzul">(INDISPONÍVEL: em breve) Cor: AZUL / Tema: ESCURO</option>                        
                        <option value="claroRosa">(INDISPONÍVEL: em breve) Cor: ROSA / Tema: CLARO</option>                        
                        <option value="EscuroRosa">(INDISPONÍVEL: em breve) Cor: ROSA / Tema: ESCURO</option>
                    </select>
                </label>
            </div>
        </div>
    </div>
</body>

</html>