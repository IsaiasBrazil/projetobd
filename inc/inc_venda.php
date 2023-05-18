<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod_cliente = $_SESSION['cod_cliente'];
$cod_vendedor = $_SESSION['cod_vendedor'];
$data = $_SESSION['data'];
$prazo_entrega = $_SESSION['prazo_entrega'];
$cond_pagto = $_SESSION['cond_pagto'];
$produtos = $_SESSION['itens_venda'];

include_once('../conexao.php');

$query = "INSERT INTO venda (data, prazo_entrega, cond_pagto,fk_cliente_cod,fk_vendedor_cod)
          VALUES ('$data', '$prazo_entrega', '$cond_pagto','$cod_cliente','$cod_vendedor')";
$resu = mysqli_query($con, $query);

if ($cod_venda = mysqli_insert_id($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Venda ".$cod_venda." cadastrada com sucesso!!</p>";
    $_SESSION['cod_venda'] = $cod_venda;
    //include_once('inc_itens_venda.php');
    //echo "<script>alert('" .$cod_cliente. "');</script>";
    //file_put_contents('log.txt', "cod_venda = ".$cod_venda . PHP_EOL, FILE_APPEND);
    // file_put_contents('log.txt', $cod_vendedor . PHP_EOL, FILE_APPEND);
    //echo "<script>alert('" .$cod_vendedor. "');</script>";
}
else {
    $_SESSION['msg'] = "<p style='color:red;'> Venda não foi cadastrada!</p>";
 
}
header("Location: inc_itens_venda.php");
mysqli_close($con);
exit();
?>