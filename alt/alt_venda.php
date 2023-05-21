<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];
$data = $_POST["data"];
$prazo_entrega = $_POST["prazo_entrega"];
$cond_pagto = $_POST["cond_pagto"];

include('../conexao.php');

$query = "UPDATE venda SET data = '$data', prazo_entrega='$prazo_entrega', cond_pagto='$cond_pagto' WHERE cod = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Venda alterada com sucesso!</p>";
    header('Location: ../lista/lista_venda.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao alterar venda!</p>";
    header('Location: ../lista/lista_venda.php');
}
mysqli_close($con);