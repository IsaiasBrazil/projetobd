<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// echo "<script>alert('".$_SESSION['cod_cliente']."');</script>";
// echo "<script>alert('".$_SESSION['cod_vendedor']."');</script>";
// echo "<script>alert('".$_POST['data']."');</script>";
// echo "<script>alert('".$_POST['prazo_entrega']."');</script>";
// echo "<script>alert('".$_POST['cond_pagto']."');</script>";

unset($_SESSION['itens_venda']);
//header('Location: cad_alt/cad_alt_venda.php');
?>