<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];

include('../conexao.php');

$query = "DELETE FROM produto WHERE cod = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Produto excluído com sucesso!</p>";
    header('Location: ../lista/lista_produto.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir produto!</p>";
    header('Location: ../lista/lista_produto.php');
}
mysqli_close($con);