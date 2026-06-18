<?php
session_start();
$id = $_SESSION['id'];
include "conecta.php";
$id_resp = $_GET['id_resp'];

$sql = "SELECT * FROM responsavel WHERE id='$id_resp'";
$resultado = mysqli_query($conn, $sql);
$naoHaDados = FALSE;

if (mysqli_num_rows($resultado) > 0) {
    $dadosResp = mysqli_fetch_assoc($resultado);
} else {
    $naoHaDados = TRUE;
}

$sqlAlunos = "SELECT * FROM aluno ORDER BY nome";
$resultadoAlunos = mysqli_query($conn, $sqlAlunos);
if (mysqli_num_rows($resultadoAlunos) > 0) {
    $dadosAluno = mysqli_fetch_assoc($resultadoAlunos);
} else {
    $naoHaDados = TRUE;
}

if ($_POST) {
    include "conecta.php";
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $alunoSubordinado = $_POST['alunoSubordinado'];

    $sql = "UPDATE responsavel SET nome = '$nome', telefone = '$telefone', id_aluno = '$alunoSubordinado' WHERE id = '$id_resp'";
    $resultados = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) > 0) {
        header("Location:listarResponsaveis.php");
    } else {
        echo "<dialog open>Houve um erro interno......</dialog>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de dados</title>
    <?php
    if ($_SESSION['temaEscuro']) {
        echo '<link rel="stylesheet" href="styleEscuro.css">';
    } else {
        echo '<link rel="stylesheet" href="style.css">';
    }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="msgExcluirResp.js"></script>
</head>

<body>
    <!---->
    <header>
        <h1>S.I.G.C[...]</h1>
        <nav>

        </nav>
    </header>
    <ul class="sidenav">
        <li><a href="index.php?id=<?php echo $id; ?>"><i class="fa-solid fa-house"></i> Início</a></li>
        <hr>
        <li><a href="listarAlunos.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
        <li><a class="active" href="listarResponsaveis.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user-tie"></i>
                Responsáveis</a></li>
        <li><a href="listarEstagiario.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user"></i> Estagiários</a></li>
        <hr>
        <li><a href="cadastrarPagamentos.php?id=<?php echo $id; ?>"><i class="fa-solid fa-piggy-bank"></i>
                Mensalidades</a></li>
        <li><a href="arrecadacao.php?id=<?php echo $id; ?>"><i class="fa-solid fa-hand-holding-dollar"></i>
                Arrecadação</a></li>
        <li><a href="despesas.php?id=<?php echo $id; ?>"><i class="fa-solid fa-brazilian-real-sign"></i> Despesas</a>
        </li>
        <hr>
        <li><a href="relatorios.php?id=<?php echo $id; ?>"><i class="fa-regular fa-clipboard"></i> Relatórios</a></li>
        <li><a href="listarAnotacoes.php?id=<?php echo $id; ?>"><i class="fa-solid fa-note-sticky"></i> Anotações</a>
        </li>
        <hr>
        <li><a href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <hr>
        <li><a href="destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>

    <div class="main-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-header">Altere os dados atuais:</div>
                <div class="card-body">
                    <form method="POST" action="">
                        <label>
                            <p>Nome completo: <span style="color:red;">*</span><br><input type="text" name="nome"
                                    value="<?php echo $dadosResp['nome']; ?>" required></p>
                        </label>
                        <label>
                            <p>Número de telefone (WhatsApp): <span style="color:red;">*</span><br><input type="text"
                                    name="telefone" value="<?php echo $dadosResp['telefone']; ?>" required></p>
                        </label>
                        <label>
                            <p>Aluno subordinado:<br>
                                <select name="alunoSubordinado">
                                    <option value=0> Não associar a nenhum aluno </option>
                                        <?php
                                        while ($dadosAluno = mysqli_fetch_assoc($resultadoAlunos)) {
                                            echo '<option value=' . $dadosAluno['id'] . '>' . $dadosAluno['nome'] . ' // (ID: ' . $dadosAluno['id'] . ')</option>';
                                        }
                                        ?>
                                </select>
                            </p>
                        </label>
                        <input type="submit" value="Alterar informações">
                        <label><a href="listarResponsaveis.php"><button>Cancelar e retornar</button></a></label>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>