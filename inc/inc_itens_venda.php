<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include_once('../conexao.php');

$cod_venda = $_SESSION['cod_venda'];
$produtos = $_SESSION['itens_venda'];
unset($_SESSION['cod_venda'],$_SESSION['itens_venda']);
$qtd = $_SESSION['$qtd']??0;
foreach ($produtos as $produto) {
    $qtd = $produto[1];
    $cod = $produto[2];
    $query = "UPDATE produto p SET qtd_estoque = (p.qtd_estoque-$qtd) where cod=$cod";
    $resu = mysqli_query($con, $query);
    if ($resu) {
        $query = "INSERT INTO itens_venda (fk_produtos_cod,fk_vendas_numero,quant_vendida)
          VALUES ('$produto[2]','$cod_venda','$qtd')";
        $resu = mysqli_query($con, $query);
        if ($resu) {
            $_SESSION['msg'] = "<p style='color:blue;'> Venda " . $cod_venda . " cadastrada com sucesso!!</p>";
        } else {
            $_SESSION['msg'] = "<p style='color:red;'> Não foi possível cadastrar esse item!</p>";
        }
    } else {
        $_SESSION['msg'] = "<p style='color:red;'> Erro ao deduzir estoque!</p>";
    }
}
mysqli_close($con);
header("Location: ../lista/lista_venda.php?tipo=consulta");
exit();
?>