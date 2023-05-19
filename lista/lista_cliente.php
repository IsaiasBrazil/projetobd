<!DOCTYPE html>

<html>

<head>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    include_once("../conexao.php");
    $query = "SELECT * FROM cliente";
    $result = mysqli_query($con, $query);
    include_once("../gridgenerico.php");
    ?>
</head>

<body>
    <?php
    grid($result, "CLIENTES");


    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        echo $msg;
        unset($_SESSION['msg']);
    }

    ?>
</body>

</html>