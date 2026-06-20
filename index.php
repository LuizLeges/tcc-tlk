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
    <title>SIGC - Dashboard</title>
    <?php
    if($_SESSION['temaEscuro']) {
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
        <li><a class="active" href="index.php?id=<?php echo $id; ?>"><i class="fa-solid fa-house"></i> Início</a></li>
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
        <li><a href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <hr>
        <li><a href="destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>

    <div class="main-wrapper">
        <div class="welcome-section">
            <h2>Olá, <span><?php echo $dadosAdmin['nome']; ?></span>!</h2>
            <p>Aqui está o resumo do sistema hoje.</p>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <div class="card-header">Fundos e Arrecadação</div>
                <div class="card-body">
                    <div class="stat-row"><span>Total:</span> <strong>R$ 0.000,00</strong></div>
                    <div class="stat-row"><span>Mensal:</span> <strong>R$ 0.000,00</strong></div>
                    <div class="stat-row"><span>Registradas:</span> <strong>00</strong></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Mensalidades Pendentes</div>
                <div class="card-body">
                    <div class="list-item">NOME DO ALUNO <span>Jan/Fev</span></div>
                    <div class="list-item">NOME DO ALUNO <span>Março</span></div>
                    <div class="list-item">NOME DO ALUNO <span>Abril</span></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Colaboradores Pontuais</div>
                <div class="card-body">
                    <div class="stat-row"><span>Total:</span> <strong>R$ 0.000,00</strong></div>
                    <div class="stat-row"><span>Mensal:</span> <strong>R$ 0.000,00</strong></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>