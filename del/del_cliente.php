<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];
$nome = $_GET["nome"];

include('../conexao.php');

$query = "DELETE FROM cliente WHERE cod = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue; font-size: 22px; font-weight: bold;'> Cliente <font color='red'>".$nome."</font> excluído(a) com sucesso!</p>";
    header("Location: ../lista/lista_cliente.php?tipo='lista'");
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir cliente!</p>";
    header("Location: ../lista/lista_cliente.php?tipo='lista'");
}
mysqli_close($con);