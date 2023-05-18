<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod_cliente = $_GET['cliente'];
$cod_vendedor = $_GET['vendedor'];
$data = $_POST['data'];
$prazo_entrega = $_POST['prazo_entrega'];
$cond_pagto = $_POST['cond_pagto'];
echo "<script>alert('$cod_cliente');</script>";
echo "<script>alert('$cod_vendedor');</script>";
echo "<script>alert('$data');</script>";
echo "<script>alert('$prazo_entrega');</script>";
echo "<script>alert('$cond_pagto');</script>";

unset($_SESSION['itens_venda']);
//header('Location: cad_alt/cad_alt_venda.php');
?>