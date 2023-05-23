<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];
$nome = $_GET["nome"];

include('../conexao.php');

$query = "DELETE FROM categoria WHERE cod = $cod";

//$resu = mysqli_query($con, $query);

try{
    $resu = mysqli_query($con, $query);
    $_SESSION['msg'] = "<p style='color:blue; font-size: 22px; font-weight: bold;'> Categoria <font color='red'>".$nome."</font> excluída com sucesso!</p>";
    header('Location: ../lista/lista_categoria.php');
} catch (mysqli_sql_exception){
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir categoria!</p>";
    header('Location: ../lista/lista_categoria.php');
}
mysqli_close($con);