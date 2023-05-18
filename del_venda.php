<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];

include('conexao.php');

$query = "DELETE FROM venda WHERE numero = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Venda excluída com sucesso!</p>";
    header('Location: lista_venda.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir venda!</p>";
    header('Location: lista_venda.php');
}
mysqli_close($con);