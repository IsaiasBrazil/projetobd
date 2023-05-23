<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];

include('../conexao.php');
$query = "DELETE FROM itens_venda WHERE fk_vendas_numero = $cod";




try {
    $resu = mysqli_query($con, $query);
    $query = "DELETE FROM venda WHERE numero = $cod";

    $resu = mysqli_query($con, $query);
    $_SESSION['msg'] = "<p style='color:blue;'> Venda número $cod excluída com sucesso!</p>";


} catch (mysqli_sql_exception) {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir venda!</p>";
}

mysqli_close($con);
header('Location: ../lista/lista_venda.php');
exit();
?>