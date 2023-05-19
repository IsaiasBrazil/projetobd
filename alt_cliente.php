<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];
$nome = $_POST["nome"];
$endereco = $_POST["endereco"];
$cpf = $_POST["cpf"];
$telefone = $_POST["telefone"];
$limite = $_POST["limite"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$email = $_POST["email"];

include('conexao.php');

$query = "UPDATE cliente SET nome = '$nome',cpf = '$cpf', telefone = '$telefone', endereco = '$endereco', limite_cred = '$limite', cidade = '$cidade', estado = '$estado', email = '$email' WHERE cod = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue;font-weight:bold;font-size:20px'> Cliente alterado com sucesso!</p>";
    header('Location: ../lista/lista_cliente.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;font-weight:bold;font-size:20px'> Erro ao alterar cliente!</p>";
    header('Location: ../lista/lista_cliente.php');
}
mysqli_close($con);