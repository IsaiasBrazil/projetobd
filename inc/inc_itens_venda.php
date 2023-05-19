<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include_once('../conexao.php');

$cod_venda = $_SESSION['cod_venda'];
$produtos = $_SESSION['itens_venda'];

foreach($produtos as $cod_pr){
$query = "INSERT INTO itens_venda (fk_produtos_cod,fk_vendas_numero,quant_vendida)
          VALUES ('$cod_pr[2]','$cod_venda','$cod_pr[1]')";
$resu = mysqli_query($con, $query);
if ($resu) {
    $_SESSION['msg'] = "<p style='color:blue;'> Venda ".$cod_venda." cadastrada com sucesso!!</p>";
}
else {
    $_SESSION['msg'] = "<p style='color:red;'> Não foi possível cadastrar esse item!</p>";
}
}
mysqli_close($con);
header("Location: ../lista/lista_venda.php");
exit();
?>