<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];
$nome = $_POST["nome"];
$endereco = $_POST["endereco"];
$telefone = $_POST["telefone"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$porc_comissao = $_POST["porc_comissao"];

include('conexao.php');

$query = "UPDATE vendedor SET nome = '$nome', telefone = '$telefone', endereco = '$endereco', cidade = '$cidade', estado = '$estado', porc_comissao = '$porc_comissao' WHERE cod = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Vendedor alterado com sucesso!</p>";
    header('Location: lista/lista_vendedor.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao alterar vendedor!</p>";
    header('Location: lista/lista_vendedor.php');
}
mysqli_close($con);