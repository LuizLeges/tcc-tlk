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
        <nav>

        </nav>
    </header>
    <ul class="sidenav">
        <li><a href="index.php?id=<?php echo $id; ?>"><i class="fa-solid fa-house"></i> Início</a></li>
        <hr><div style="padding: 10px;"><span style="font-size:20px;">Pessoas</span></div>
        <li><a class="active" href="listarAlunos.php?id=<?php echo $id; ?>"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
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
        <div class="content">

            <div
                style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 200px; padding: 30px; margin: 20px auto; max-width: 500px; background-color: #fcfcf3; border: 1px solid #d8d8c8; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center; font-family: sans-serif;">
                <i class="fa-solid fa-triangle-exclamation" style="color: #006b92; width: 20px;"></i>
                <h3 style="margin: 0 0 10px 0; color: #004d61; font-size: 1.4rem;">
                    Setor finalizando a manutenção!
                </h3>

                <p style="margin: 0; color: #5c5c4f; font-size: 1rem; line-height: 1.5;">
                    Essa funcionalidade não está 100% concluída... <br> pode acontecer algo indesperado!
                </p>
            </div>

            <div class="card">
                <div class="card-header">Lista de responsáveis</div>
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