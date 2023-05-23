<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];
$nome = $_GET["nome"];
// $telefone = $_POST["telefone"];
// $porc_comissao = $_POST["porc_comissao"];
// $estado = $_POST["estado"];
// $cidade = $_POST["cidade"];
// $endereco = $_POST["endereco"];

include('../conexao.php');

$query = "DELETE FROM vendedor WHERE cod = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue; font-size: 22px; font-weight: bold;'> Vendedor <font color='red'>".$nome."</font> excluído(a) com sucesso!</p>";
    header('Location: ../lista/lista_vendedor.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao excluir vendedor!</p>";
    header('Location: ../lista/lista_vendedor.php');
}
mysqli_close($con);