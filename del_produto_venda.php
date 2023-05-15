<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$mensa = $_SESSION['itens_venda'][$_GET['key']][0];
//echo "<script>alert('$mensa');</script>";
unset($_SESSION['itens_venda'][$_GET['key']]);
header("Location:cad_alt_venda.php?mensa=".$mensa);
?>
