<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$cod = $_GET["cod"];
$nome = $_POST["nome"];
$preco = $_POST["preco"];
$qtd_estoque = $_POST["qtd_estoque"];
$cod_categoria = $_POST["fk_categoria_id"];
$unidade_medida = $_POST["unidade_medida"];
echo "<script>alert('".$cod_categoria."');</script>";

include('conexao.php');

$query = "UPDATE produto SET nome = '$nome', preco='$preco', qtd_estoque='$qtd_estoque', fk_categoria_id='$cod_categoria', unidade_medida='$unidade_medida' WHERE cod = $cod";

$resu = mysqli_query($con, $query);

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Produto alterado com sucesso!</p>";
    header('Location: lista_produto.php');
} else {
    $_SESSION['msg'] = "<p style='color:red;'> Erro ao alterar produto!</p>";
    header('Location: lista_produto.php');
}
mysqli_close($con);