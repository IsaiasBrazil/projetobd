<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];

include('conexao.php');

$query = "DELETE FROM produto WHERE cod = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Vendedor excluído com sucesso!</p>";
    header('Location: lista_vendedor.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir vendedor!</p>";
    header('Location: lista_vendedor.php');
}
mysqli_close($con);