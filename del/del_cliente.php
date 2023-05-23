<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];
$nome = $_GET["nome"];
// $endereco = $_POST["endereco"];
// $cpf = $_POST["cpf"];
// $telefone = $_POST["telefone"];
// $limite = $_POST["limite"];
// $cidade = $_POST["cidade"];
// $estado = $_POST["estado"];
// $email = $_POST["email"];

include('../conexao.php');

$query = "DELETE FROM cliente WHERE cod = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue; font-size: 22px; font-weight: bold;'> Cliente <font color='red'>".$nome."</font> excluído(a) com sucesso!</p>";
    header('Location: ../lista/lista_cliente.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir cliente!</p>";
    header('Location: ../lista/lista_cliente.php');
}
mysqli_close($con);