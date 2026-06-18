<?php
session_start();
$id = intval($_GET['idResp']);
include "conecta.php";
$sql = "DELETE FROM responsavel WHERE id='$id'";
$resultado = mysqli_query($conn, $sql);
header("Location:listarResponsaveis.php");
exit;