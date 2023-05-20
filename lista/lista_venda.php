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
<div style="overflow:auto">
    <?php
    require_once("../gridgenerico.php");
    grid($result,"VENDAS");
    ?>
</div>
</body>

</html>