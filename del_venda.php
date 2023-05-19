<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];

include('conexao.php');

$query = "DELETE FROM venda WHERE numero = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Venda excluída com sucesso!</p>";
    
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir venda!</p>";
    
}

$query = "DELETE FROM itens_venda WHERE fk_vendas_numero = $cod";
$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = $_SESSION['msg']."<br><p style='color:blue;'> produto excluído com sucesso!</p>";
    
} else {
    $_SESSION['msg'] = $_SESSION['msg']."<br><p style='color:red;'> Erro ao excluir produto!</p>";
    
}
mysqli_close($con);
header('Location:lista/lista_venda.php');
exit();
?>