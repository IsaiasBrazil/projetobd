<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];

include('conexao.php');

$query = "DELETE FROM categoria WHERE cod = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Categoria excluída com sucesso!</p>";
    header('Location: lista_categoria.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir categoria!</p>";
    header('Location: lista_categoria.php');
}
mysqli_close($con);