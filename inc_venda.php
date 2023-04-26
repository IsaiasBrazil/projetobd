<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$data = $_POST["data"];
$prazo_entrega = $_POST["prazo_entrega"];
$cond_pagto = $_POST["cond_pagto"];

include('conexao.php');

$query = "INSERT INTO venda (data, prazo_entrega, cond_pagto)
          VALUES ('$data', '$prazo_entrega', '$cond_pagto')";
$resu = mysqli_query($con, $query);

if (mysqli_insert_id($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Venda cadastrada com sucesso!!</p>";
    header("Location: lista_venda.php");
}
else {
    $_SESSION['msg'] = "<p style='color:red;'> Venda não foi cadastrada!</p>";
    header("Location: lista_venda.php");
}
mysqli_close($con);
?>