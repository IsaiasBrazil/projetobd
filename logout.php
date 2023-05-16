<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
foreach ($_SESSION['itens_venda'] as $key => &$item) {
    unset($_SESSION['itens_venda'][$key]);
}
header('Location: cad_alt_venda.php');
?>
