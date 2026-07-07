<?php
include "conecta.php";
session_start(); // descobri depois de um tempo que precisa chamar session_start() em todos arquivos
//de cara já verifica se tem sessão existente
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sqlAdmin = "SELECT * FROM administrador WHERE id= '$id'";
    $resAdmin = mysqli_query($conn, $sqlAdmin);
    $dadosAdmin = mysqli_fetch_assoc($resAdmin);
    $_SESSION["tema"] = $dadosAdmin["tema"];
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
    if ($_SESSION['tema'] == 'verdeEscuro') { //VERDE ESCURO
        echo '<link rel="stylesheet" href="styleVerdeEscuro.css">';
    } else if ($_SESSION['tema'] == 'verdeClaro') { // VERDE CLARO
        echo '<link rel="stylesheet" href="styleVerdeClaro.css">';
    } else if ($_SESSION['tema'] == 'azulEscuro') { // AZUL ESCURO
        echo '<link rel="stylesheet" href="styleAzulEscuro.css">';
    } else if ($_SESSION['tema'] == 'azulClaro') { // AZUL CLARO
        echo '<link rel="stylesheet" href="styleAzulClaro.css">';
    } else if ($_SESSION['tema'] == 'rosaEscuro') { // ROSA ESCURO
        echo '<link rel="stylesheet" href="styleRosaEscuro.css">';
    } else if ($_SESSION['tema'] == 'rosaClaro') { // ROSA CLARO
        echo '<link rel="stylesheet" href="styleRosaClaro.css">';
    } else { // PADRÃO
        echo '<link rel="stylesheet" href="styleVerdeClaro.css">';
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
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Pessoas</span></div>
        <li><a href="listarAlunos.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
        <li><a href="listarResponsaveis.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user-tie"></i> Responsáveis</a></li>
        <li><a href="listarEstagiario.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user"></i> Estagiários</a></li>
        <li><a href="cadastrarUsuario.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user-shield"></i> Usuários</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Valores</span></div>
        <li><a href="listarMensalidades.php?id=<?php echo $id; ?>"><i class="fa-solid fa-piggy-bank"></i> Mensalidades</a></li>
        <li><a href="arrecadacao.php?id=<?php echo $id; ?>"><i class="fa-solid fa-hand-holding-dollar"></i> Arrecadação</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Gestão</span></div>
        <li><a href="relatorios.php?id=<?php echo $id; ?>"><i class="fa-regular fa-clipboard"></i> Relatórios</a></li>
        <li><a href="listarAnotacoes.php?id=<?php echo $id; ?>"><i class="fa-solid fa-note-sticky"></i> Anotações</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Configurações</span></div>
        <li><a href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <hr>
        <li><a href="destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>

    <div class="main-wrapper">
        <div class="welcome-section">
            <h2>Olá, <span><?php echo $dadosAdmin['nome']; ?></span>!</h2>
            <p>Aqui está o resumo do sistema hoje.</p>
            <?php
            if ($dadosAdmin['id'] == 1) { //pequeno aviso para caso o usuer logado seja o padrão do banco.
                echo '<div class="bloco-nota" style="border: 2px solid #ffc107; background-color: #fffbeb; padding: 15px; border-radius: 5px; margin: 15px 0; font-family: sans-serif;">
                        <h3 style="color: #d97706; margin-top: 0; margin-bottom: 10px;">Lembrete:</h3>
                        <p style="color: #333333; margin: 5px 0;">
                        Você está conectado como <span style="font-weight: bold; color: #d97706;">usuário padrão</span>.
                        </p>
                        <p style="color: #555555; margin: 5px 0;">
                        Para maior segurança, use esta conta preferencialmente para recuperação de senha.
                        </p>
                        <p style="color: #555555; margin: 5px 0;">
                        Acesse a página de <a href="cadastrarUsuario.php" style="color: #b45309; font-weight: bold; text-decoration: underline;">Usuários</a> para registrar uma nova conta de uso diário.
                        </p>
                    </div>';
            }
            ?>
        </div>

        <!-- <div class="dashboard-grid"> tirei essa div que ajusta as outras uma ao lado da outra. -->
        <div class="card">
            <div class="card-header">Atalhos de Funções</div>
            <div class="card-body" style="text-align: center;">

                <label>
                    <button onclick="location.href='cadastrarResponsavel.php'"> 
                        <!-- Usa-se o "onclick" ao invés de <button> dentro de <a> porque, supostamente, é uma prática inválida -->
                        <i class="fa-solid fa-user-tie"></i> Cadastrar Responsável
                    </button>
                </label>

                <label>
                    <button onclick="location.href='cadastrarAluno.php'">
                        <i class="fa-solid fa-user-graduate"></i> Cadastrar Aluno
                    </button>
                </label>

                <label>
                    <button onclick="location.href='listarMensalidades.php'">
                        <i class="fa-solid fa-file-invoice-dollar"></i> Cadastrar Mensalidade
                    </button>
                </label>

                <label>
                    <button onclick="location.href='cadastrarAnotacao.php'">
                        <i class="fa-solid fa-sticky-note"></i> Criar Anotação
                    </button>
                </label>

            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">Fundos e Arrecadação</div>
            <div class="card-body">
                <div class="stat-row"><span>Total:</span> <strong>R$ 0.000,00</strong></div>
                <div class="stat-row"><span>Mensal:</span> <strong>R$ 0.000,00</strong></div>
                <div class="stat-row"><span>Registradas:</span> <strong>00</strong></div>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">Mensalidades Pendentes</div>
            <div class="card-body">
                <div class="list-item">NOME DO ALUNO <span>Jan/Fev</span></div>
                <div class="list-item">NOME DO ALUNO <span>Março</span></div>
                <div class="list-item">NOME DO ALUNO <span>Abril</span></div>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">Colaboradores Pontuais</div>
            <div class="card-body">
                <div class="stat-row"><span>Total:</span> <strong>R$ 0.000,00</strong></div>
                <div class="stat-row"><span>Mensal:</span> <strong>R$ 0.000,00</strong></div>
            </div>
        </div>
    </div>
    <!-- </div> -->

</body>

</html>