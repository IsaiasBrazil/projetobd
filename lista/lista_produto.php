<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
include_once("../conexao.php");
if (isset($_GET['cod']))
$query = "SELECT * FROM produto p INNER JOIN itens_venda i where i.fk_produtos_cod = p.cod and i.fk_vendas_numero ='".$_GET['cod']."' ";
else
$query = "SELECT * FROM produto";
$result = mysqli_query($con, $query);
include_once("../gridgenerico.php");
grid($result, "PRODUTOS");
?>