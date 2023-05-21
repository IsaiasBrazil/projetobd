<!DOCTYPE html>

<html>

<head>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    include_once("../conexao.php");
    include_once("../gridgenerico.php");
    ?>

<body>
    <?php
    if (isset($_GET['cod'])) {
        $query = "SELECT * FROM produto p INNER JOIN itens_venda i where i.fk_produtos_cod = p.cod and i.fk_vendas_numero ='" . $_GET['cod'] . "' ";
        unset($_GET['cod']);
        $_SESSION['lista_produtos_venda'] = 1;
    } else {
        ?>
        <div>
            <form method="POST">
                <label for="filtro">Filtrar por categoria:</label>
                <input type="text" name="filtro" id="filtro">
                <input type="submit" value="Aplicar filtro">
            </form>
        </div>
        <?php
         $categoria = $_POST['filtro']??"";
         $query = "SELECT * FROM categoria c INNER JOIN produto p where p.fk_categoria_id=c.cod and c.descricao like '%$categoria%'";
    }
    ?>
    <div style="overflow:auto">
        <?php
        $result = mysqli_query($con, $query);
        grid($result, "PRODUTOS");
        ?>
    </div>
</body>

</html>
<?php
exit();
?>