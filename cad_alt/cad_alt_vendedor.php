<?php
$tipo = "Cadastro";
$action = "../inc/inc_vendedor.php";
$cod = "";
$nome = "";
$endereco = "";
$cpf = "";
$telefone = "";
$limite = "";
$cidade = "";
$estado = "";
$email = "";
$porc_comissao = "";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    $action = "../alt/alt_vendedor.php?cod=" . $_GET['cod']."&nome=".$_GET["nome"];
    $tipo = "Alteração";
    include_once("../conexao.php");
    $query = "SELECT * FROM vendedor where cod = $cod";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $nome = $row['nome'];
    $endereco = $row['endereco'];
    $telefone = $row['telefone'];
    $cidade = $row['cidade'];
    $estado = $row['estado'];
    $porc_comissao = $row['porc_comissao'];
    unset($_GET['cod']);
}
?>
<!DOCtype html>
<html>

<head>
    <meta charset="UTF-8">
    <title> <?= $tipo ?> de vendedores </title>
    <script>
            function mascara_telefone(elem) {
                if (!elem.value) return elem.value = "";
                elem.value = elem.value.replace(/\D/g, '')
                elem.value = elem.value.replace(/(\d{2})(\d)/, "($1)$2")
                elem.value = elem.value.replace(/(\d)(\d{4})$/, "$1-$2")
            }
    </script>
</head>

<body>
    <table style="background-color: lightsteelblue; border:1px solid black">
        <thead>
            <tr>
                <td style="border:1px solid black">
                    <p>
                    <h1>
                        <?= $tipo ?> de vendedores
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
                    <form action='<?= $action; ?>' method="POST">
                        <p style="margin-top:10px;"> Nome:<input style="border-width: 3px;margin-left: 21px;" type="text" value='<?=$nome?>' name="nome" id="nome" size="80" maxlength="100" required>
                        </p>
                        <p> Telefone:<input value='<?=$telefone?>' style="border-width: 3px;margin-left: 5px;" type="text" name="telefone" size="14" maxlength="14" onkeyup="mascara_telefone(this)" placeholder="(xx)xxxxx-xxxx" required></p>
                        <p> Comissão (%):<input value='<?=$porc_comissao?>' style="border-width: 3px;margin-left: 5px;" type="text" name="porc_comissao" size="14" maxlength="14" required></p>
                        Estado:
                        <select style="border-width: 3px;margin-left: 14px;" name="estado" id="estado">
                            <?php
                            $cidades = file_get_contents("../estados-cidades.json");
                            $decode = json_decode($cidades, TRUE);
                            foreach ($decode["estados"] as $valor) {
                                $selected = $valor["sigla"]==$estado?"selected":"";
                                echo "<option value='" . $valor["sigla"] . "' $selected>".$valor["nome"]."</option>";
                            }
                            ?>
                        </select>
                        <p> Cidade<input value='<?=$cidade?>' style="border-width: 3px;margin-left: 21px;" type="text" size="80" maxlength="80" name="cidade" required></p>
                        <p> Endereço:<input value='<?=$endereco?>' style="border-width: 3px;margin-left: 2px;" type="text" size="80" maxlength="100" name="endereco" required></p>
                        <p> 
                            <input style="border-width: 3px;margin-left: 0px;" type="submit" value="Enviar">
                            <input style="border-width: 3px;margin-left: 10px;" type="reset" value="Limpar">
                            <button  type="button" style="border-width: 3px;margin-left: 10px;"
                                onclick="window.location.href='../index.php'">Ir para Home</button>
                        </p>
                    </form>
                </td>
            </tr>
        </tbody>
</body>

</html>