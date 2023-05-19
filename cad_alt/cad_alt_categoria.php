<?php
$tipo = "Cadastro";
$action = "../inc/inc_categoria.php";
$cod = "";
$descricao = "";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    $action = "../alt_categoria.php?cod=" . $_GET['cod'];
    $tipo = "Alteração";
    include_once("../conexao.php");
    $query = "SELECT * FROM categoria where cod=$cod";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $descricao = $row['descricao'];
    unset($_GET['cod']);
}
?>
<!DOCtype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        <?= $tipo ?> de categorias
    </title>
</head>

<body>
    <table style="background-color: lightsteelblue; border:1px solid black">
        <thead>
            <tr>
                <td style="border:1px solid black">
                    <p>
                    <h1>
                        <?= $tipo ?> de categorias
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
                        <p style="margin-top:10px;"> Descrição:<input style="border-width: 3px;margin-left: 21px;"
                                type="text" value='<?= $descricao ?>' name="descricao" id="descricao" size="80"
                                maxlength="500" required>
                        </p>

                        <input style="border-width: 3px;margin-left: 0px;" type="submit" value="Enviar">
                        <input style="border-width: 3px;margin-left: 10px;" type="reset" value="Limpar">
                    </form>

                </td>
            </tr>
        </tbody>
</body>

</html>