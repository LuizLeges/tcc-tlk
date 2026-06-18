<?php
$bdServidor = 'localhost'; 
$bdUsuario = 'root'; 
$bdSenha = '';
$bdBanco = 'sigc';
mysqli_report(MYSQLI_REPORT_OFF);
$conn = @mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);
if (!$conn) {
    echo('Erro de conexão: ' . 
        mysqli_connect_error());
    die();
}
