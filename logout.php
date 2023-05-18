<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

unset($_SESSION['itens_venda']);
header("Location:cad_alt/cad_alt_venda.php");
?>

