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
    $query = "SELECT * FROM categoria";
    $result = mysqli_query($con, $query);
    include_once("../gridgenerico.php");
    ?>

<body>
    <div style="overflow:auto">
        <?php
        grid($result, "CATEGORIAS");
        ?>
    </div>
</body>

</html>