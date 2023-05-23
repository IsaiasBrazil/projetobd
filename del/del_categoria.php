<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];

include('../conexao.php');

$query = "DELETE FROM categoria WHERE cod = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue; font-size: 22px; font-weight: bold;'> Categoria <font color='red'>".$nome."</font> excluído(a) com sucesso!</p>";
    header('Location: ../lista/lista_categoria.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir categoria!</p>";
    header('Location: ../lista/lista_categoria.php');
}
mysqli_close($con);