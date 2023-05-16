<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
unset($_SESSION['itens_venda']);
session_destroy();
session_start();
header('Location: cad_alt_venda.php');
//. $_SERVER['HTTP_REFERER']
?>
