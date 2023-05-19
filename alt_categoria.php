<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];
$descricao = $_POST["descricao"];

include('conexao.php');

$query = "UPDATE categoria SET descricao = '$descricao' WHERE cod = '$cod'";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Categoria alterada com sucesso!</p>";
    header('Location: lista/lista_categoria.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao alterar categoria!</p>";
    header('Location: lista/lista_categoria.php');
}
mysqli_close($con);