<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$_SESSION['mensa']=$_SESSION['itens_venda'][$_GET['key']][0];
unset($_SESSION['itens_venda'][$_GET['key']]);
header("Location: ../cad_alt/cad_alt_venda.php");
?>
