<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

include_once("conexao.php");
$query = "SELECT * FROM venda";
$result = mysqli_query($con, $query);
include_once("gridgenerico.php");
$_SESSION['cod_vendas']=grid($result, "VENDAS");
?>