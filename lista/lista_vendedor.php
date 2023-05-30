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
    $nome = $_POST['filtro']??"";
    $query = "SELECT * FROM vendedor v where v.nome like '%$nome%'";
    $result = mysqli_query($con, $query);
    include_once("../gridgenerico.php");
    ?>
</head>

<body>
    <div>
        <form method="POST">
            <label for="filtro">Filtrar por nome:</label>
            <input type="text" name="filtro" id="filtro">
            <input type="submit" value="Aplicar filtro">
        </form>
    </div>
    <div style="overflow: auto;">
        <?php
        grid($result, "VENDEDORES",$_GET['tipo']);
        ?>
    </div>
</body>

</html>