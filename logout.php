<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
session_destroy();
session_start();
unset($_SESSION);
header("Location:cad_alt/cad_alt_venda.php");
exit();
?>