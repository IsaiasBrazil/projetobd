<!DOCTYPE html>

<html>

<head>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include_once("../conexao.php");
$query = "SELECT * FROM venda";
$result = mysqli_query($con, $query);
?>
</head>
<body>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    };
    require_once("../gridgenerico.php");
    grid($result,"VENDAS");
    ?>

</body>

</html>