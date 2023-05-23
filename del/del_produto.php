<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];

include('../conexao.php');

$query = "DELETE FROM produto WHERE cod = $cod";


try{
    $resu = mysqli_query($con, $query);
    $_SESSION['msg'] = "<p style='color:blue;'> Produto excluído com sucesso!</p>";
    header('Location: ../lista/lista_produto.php');
} catch(mysqli_sql_exception) {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir produto! Verifique se não existem vendas cadastradas com este produto antes de tentar excluí-lo.</p>";
    header('Location: ../lista/lista_produto.php');
}
mysqli_close($con);