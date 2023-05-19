<?php
$tipo = "Cadastro";
$action = "../inc/inc_produto.php";
$cod = "";
$nome = "";
$preco = "";
$qtd_estoque = "";
$unidade_medida = "";
$fk_categoria_id ="";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    $action = "../alt_produto.php?cod=" . $_GET['cod'];
    $tipo = "Alteração";
    include_once("../conexao.php");
    $query = "SELECT * FROM produto where cod=$cod";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $nome = $row['nome'];
    $preco = $row['preco'];
    $qtd_estoque = $row['qtd_estoque'];
    $unidade_medida = $row['unidade_medida'];
    $fk_categoria_id = $row['fk_categoria_id'];
    unset($_GET['cod']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> <?= $tipo ?> de produtos </title>
</head>

<body>
    <table style="background-color: lightsteelblue; border:1px solid black">
        <thead>
            <tr>
                <td style="border:1px solid black">
                    <p>
                    <h1>
                        <?= $tipo ?> de produtos
                    </h1>
                    </p>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    ?>
                    <form action='<?= $action ?>' method="POST">
                        <p style="margin-top:10px;"> Nome:<input style="border-width: 3px;margin-left: 21px;"
                                type="text" value='<?=$nome?>' name="nome" id="nome" size="80" maxlength="100" required>
                        </p>
                        <P> Preço:<input value='<?=$preco?>' style="border-width: 3px;margin-left: 5px;" type="text" name="preco" size="14" maxlength="14" required></P>
                        <P> Quantidade em estoque:<input value='<?=$qtd_estoque?>' style="border-width: 3px;margin-left: 5px;" type="text" name="qtd_estoque"
                        size="14" maxlength="14" required></P>
                        <p> Unidade de medida:<input value='<?=$unidade_medida?>' style="border-width: 3px;margin-left: 21px;" type="text" size="80"
                                maxlength="2" name="unidade_medida" required></p>
                        <p> Categoria: 
                            <select name="fk_categoria_id" id="fk_categoria_id">
                                <?php 
                                    include_once("../conexao.php");
                                    $query = "SELECT * FROM categoria";
                                    $result = mysqli_query($con, $query);
                                    foreach ($result as $elem) {
                                        $selected = $elem['cod']==$fk_categoria_id?"selected":"";
                                        echo "<option value='".$elem['cod']."' $selected>".$elem['descricao']."</option>";
                                    }
                                ?>
                              
                            </select>
                        </p>
                    
                        <p> 
                            <input style="border-width: 3px;margin-left: 0px;" type="submit" value="Enviar">
                            <input style="border-width: 3px;margin-left: 10px;" type="reset" value="Limpar">
                        </p>
                    </form>
                </td>
            </tr>
        </tbody>
</body>

</html>