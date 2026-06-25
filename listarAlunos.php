<?php
session_start();
$id = $_SESSION['id'];
include "conecta.php";

$sql = "SELECT * FROM aluno";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listar alunos</title>
    <?php
    if($_SESSION['tema'] == 'verdeEscuro') { //VERDE ESCURO
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
    } else if ($_SESSION['tema'] == 'vermelhoEscuro') { // VERMELHO ESCURO
        echo '<link rel="stylesheet" href="styleVermelhoEscuro.css">';
    } else if ($_SESSION['tema'] == 'vermelhoClaro') { // VERMELHO CLARO
        echo '<link rel="stylesheet" href="styleVermelhoClaro.css">';
    } else if ($_SESSION['tema'] == 'amareloEscuro') { // AMARELO ESCURO
        echo '<link rel="stylesheet" href="styleAmareloEscuro.css">';
    } else if ($_SESSION['tema'] == 'amareloClaro') {// AMARELO CLARO
        echo '<link rel="stylesheet" href="styleAmareloClaro.css">';
    } else {// PADRÃO
        echo '<link rel="stylesheet" href="styleVerdeClaro.css">';
    }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <header>
        <h1>S.I.G.C[...]</h1>
        <nav>

        </nav>
    </header>
    <ul class="sidenav">
        <li><a href="index.php?id=<?php echo $id; ?>"><i class="fa-solid fa-house"></i> Início</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Pessoas</span></div>
        <li><a class="active" href="listarAlunos.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
        <li><a href="listarResponsaveis.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user-tie"></i> Responsáveis</a></li>
        <li><a href="listarEstagiario.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user"></i> Estagiários</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Valores</span></div>
        <li><a href="listarMensalidades.php?id=<?php echo $id; ?>"><i class="fa-solid fa-piggy-bank"></i> Mensalidades</a></li>
        <li><a href="despesas.php?id=<?php echo $id; ?>"><i class="fa-solid fa-brazilian-real-sign"></i> Despesas</a></li>
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
        <div class="content">

            <div class="card">
                <div class="card-header">Pesquisa</div>
                <div class="card-body">
                    <form method="POST" action="">
                        <p><input type="text" name="pesquisa" placeholder="Digite o nome do responsável"></p>
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                        <?php
                        if ($_POST) {
                            if (isset($_POST['pesquisa'])) {
                                $pesquisa = $_POST['pesquisa'];
                                $sql = "SELECT * FROM aluno WHERE nome LIKE '%$pesquisa%' ORDER BY nome";
                            } else {
                                $sql = "SELECT * FROM aluno ORDER BY nome";
                                $pesquisa = "";
                            }
                            $resultado = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($resultado) > 0) {
                                $numResultados = 0;
                                if ($pesquisa != "") {
                                    echo '<h3>Resultados encontrados para: <span>"' . $pesquisa . '"</span></h3>';
                                    echo '<table>';
                                    while ($resPesquisa = mysqli_fetch_assoc($resultado)) {
                                        $numResultados++;
                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $resPesquisa['nome']; ?>
                                            </td>
                                            <td>
                                                <?php echo $resPesquisa['telefone']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $idAluno = "SELECT nome FROM aluno WHERE id =" . $resPesquisa['id_aluno'];
                                                $buscaAluno = mysqli_query($conn, $idAluno);
                                                if (mysqli_num_rows($buscaAluno) > 0) {
                                                    $nomeAluno = mysqli_fetch_assoc($buscaAluno);
                                                    echo $nomeAluno['nome'];
                                                } else {
                                                    echo '<span style="color:red;">Nenhum aluno associado!</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $resPesquisa['id']; ?>
                                            </td>
                                            <td class="acoes">
                                                <a class="botaoTable" href="editarAluno.php?id_aluno=<?php echo $resPesquisa['id']; ?>">
                                                    <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <button class="botaoTable_excluir botaoAbrir" data-id="<?php echo $resPesquisa['id']; ?>">
                                                    Excluir <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </td>
                                        </tr>
                        <?php
                                    }
                                    echo '</table>';
                                    echo '<p><strong>Total de resultados encontrados: ' . $numResultados . '</strong></p>';
                                }
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-header">Lista de alunos</div>
                <div class="card-header"><label><a href="cadastrarAluno.php"><button> <i class="fa-solid fa-user-tie"></i> Cadastrar um novo Aluno</button></a></label></div>
                <div class="card-body">
                    <table border="1">
                        <tr>
                            <th>Nome Completo</th>
                            <th>Nome de guerra</th>
                            <th>Número de guerra</th>
                            <th>Estagiando</th>
                            <th>Monitor</th>
                            <th>Graduação</th>
                            <th>Pelotão</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        $numLinhasImpressas = 0;
                        while ($dados = mysqli_fetch_assoc($resultado)) {
                            $numLinhasImpressas++;
                        ?>
                            <tr>
                                <td>
                                    <?php echo $dados['nome']; ?>
                                </td>
                                <td>
                                    <?php echo $dados['nome_guerra']; ?>
                                </td>
                                <td>
                                    <?php echo $dados['numero']; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($dados['estagiando'] == 1) {
                                        echo '<span style="color:green;">Sim</span>';
                                    } else {
                                        echo '<span style="color:red;">Não</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($dados['monitor'] == 1) {
                                        echo '<span style="color:green;">Sim</span>';
                                    } else {
                                        echo '<span style="color:red;">Não</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $dados['graduacao']; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($dados['id_pelotao'] == 1) {
                                        echo 'Águia';
                                    } else if ($dados['id_pelotao'] == 2) {
                                        echo 'Falcão';
                                    } else if ($dados['id_pelotao'] == 3) {
                                        echo 'Tigre';
                                    } else if ($dados['id_pelotao'] == 4) {
                                        echo 'Leão';
                                    } else if ($dados['id_pelotao'] == 5) {
                                        echo 'Cobra';
                                    } else {
                                        echo '<span style="color:red;">Nenhum pelotão pertencente!</span>';
                                    }
                                    ?>
                                </td>

                                <td class="acoes">
                                    <a class="botaoTable" href="editarResponsavel.php?id_resp=<?php echo $dados['id']; ?>">
                                        <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </a>
                                    <a class="botaoTable"
                                        href="msgExcluirResp.php?nome=<?php echo urlencode($dados['nome']); ?>&id=<?php echo $dados['id']; ?>">
                                        <button class="botaoTable_excluir"> Excluir <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        if ($numLinhasImpressas == 0) {
                        ?>
                            <h3 style="color: red;">Não existem alunos cadastrados no sistema!</h3>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="content">
            <br>
            <label>
                <a href="cadastrarResponsavel.php?id=<?php echo htmlspecialchars($id); ?>">
                    <button>Cadastrar</button>
                </a>
            </label>
        </div>
    </div>

</body>

</html>