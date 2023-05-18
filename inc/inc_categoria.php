<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


$descricao = $_POST["descricao"];

include('../conexao.php');

$query = "INSERT INTO categoria (descricao)
          VALUES ('$descricao')";
$resu = mysqli_query($con, $query);

if (mysqli_insert_id($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Categoria cadastrada com sucesso!!</p>";
    header("Location: ../lista_categoria.php");
}
else {
    $_SESSION['msg'] = "<p style='color:red;'> Categoria não foi cadastrada!</p>";
    header("Location: ../lista_categoria.php");
}
mysqli_close($con);
?>