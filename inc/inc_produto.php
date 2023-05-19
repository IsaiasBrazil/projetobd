<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$nome = $_POST["nome"];
$preco = $_POST["preco"];
$qtd_estoque = $_POST["qtd_estoque"];
$cod_categoria = $_POST["fk_categoria_id"];
$unidade_medida = $_POST["unidade_medida"];
echo "<script>alert('".$cod_categoria."');</script>";

include('../conexao.php');

$query = "INSERT INTO produto (nome, preco, qtd_estoque, fk_categoria_id ,unidade_medida)
          VALUES ('$nome', '$preco', '$qtd_estoque', '$cod_categoria','$unidade_medida')";
$resu = mysqli_query($con, $query);

if (mysqli_insert_id($con)) {
    $_SESSION['msg'] = "<p style='color:blue;'> Produto cadastrado com sucesso!!</p>";
    header("Location: ../lista/lista_produto.php");
}
else {
    $_SESSION['msg'] = "<p style='color:red;'> Produto não foi cadastrado!</p>";
    header("Location: ../lista/lista_produto.php");
}
mysqli_close($con);
?>