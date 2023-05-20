<!DOCTYPE html>

<html>

<head>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    include_once("../conexao.php");
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
    <div style="overflow:auto;">
        <?php
        $nome = $_POST['filtro']??"";
        $query = "SELECT * FROM cliente c where c.nome like '%$nome%'";
        $result = mysqli_query($con, $query);
        grid($result, "CLIENTES");
        if (isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            echo $msg;
            unset($_SESSION['msg']);
        }
        ?>
    </div>
</body>

</html>