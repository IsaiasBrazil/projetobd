<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$nome = $_POST["nome"];
$telefone = $_POST["telefone"];
$porc_comissao = $_POST["porc_comissao"];
$estado = $_POST["estado"];
$cidade = $_POST["cidade"];
$endereco = $_POST["endereco"];

include('conexao.php');

$query = "INSERT INTO vendedor (nome, endereco, cidade, estado, telefone, porc_comissao)
          VALUES ('$nome', '$endereco', '$cidade', '$estado', '$telefone', '$porc_comissao')";
$resu = mysqli_query($con, $query);

if (mysqli_insert_id($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Vendedor cadastrado com sucesso!!</p>";
    header("Location: lista_vendedor.php");
}
else {
    $_SESSION['msg'] = "<p style='color:red;'> Vendedor não foi cadastrado!</p>";
    header("Location: lista_vendedor.php");
}
mysqli_close($con);
?>