<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod_cliente = $_SESSION['cod_cliente'];
$cod_vendedor = $_SESSION['cod_vendedor'];
$data = $_SESSION['data'];
$prazo_entrega = $_SESSION['prazo_entrega'];
$cond_pagto = $_SESSION['cond_pagto'];
$produtos = $_SESSION['itens_venda'] ?? array();

include_once('../conexao.php');

$query = "INSERT INTO venda (data, prazo_entrega, cond_pagto,fk_cliente_cod,fk_vendedor_cod)
          VALUES ('$data', '$prazo_entrega', '$cond_pagto','$cod_cliente','$cod_vendedor')";

if (count($produtos) > 0) {
    $resu = mysqli_query($con, $query);
    if ($cod_venda = mysqli_insert_id($con)) {
        $_SESSION['msg'] = "<p style='color:blue;'> Venda " . $cod_venda . " cadastrada com sucesso!!</p>";
        $_SESSION['cod_venda'] = $cod_venda;

    } else {
        $_SESSION['msg'] = "<p style='color:red;'> Venda não foi  cadastrada!</p>";
        header("Location: ../../lista/lista_venda.php?tipo=consulta");
        mysqli_close($con);
    }
} else {
    $_SESSION['msg']="<font color='red'><script>alert('Faltou cadastrar produtos na venda');</script></font>";
    header("Location: ../cad_alt/cad_alt_venda.php");
    
exit();
}
header("Location: ../inc/inc_itens_venda.php");
mysqli_close($con);
exit();
?>