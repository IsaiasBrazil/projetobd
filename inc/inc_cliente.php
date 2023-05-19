<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$nome = $_POST["nome"];
$endereco = $_POST["endereco"];
$cpf = $_POST["cpf"];
$telefone = $_POST["telefone"];
$limite = $_POST["limite"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$email = $_POST["email"];

include('../conexao.php');

$query = "INSERT INTO cliente(nome, cpf, telefone, endereco, limite_cred, cidade, estado, email)
VALUES('$nome','$cpf','$telefone','$endereco','$limite', '$cidade', '$estado','$email' )";

$resu = mysqli_query($con, $query);

if (mysqli_insert_id($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Cliente cadastrado com sucesso!</p>";
    header('Location: ../lista/lista_cliente.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao cadastrar cliente!</p>";
    header('Location: ../lista/lista_cliente.php');
}
mysqli_close($con);