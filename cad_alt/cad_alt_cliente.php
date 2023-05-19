<?php
$tipo = "Cadastro";
$action = "../inc/inc_cliente.php";
$botaoreset = "Limpar";
$cod = "";
$nome = "";
$endereco = "";
$cpf = "";
$telefone = "";
$limite = "";
$cidade = "";
$estado = "";
$email = "";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_GET['cod'])) {
    $botaoreset = "desfazer";
    $cod = $_GET['cod'];
    $action = "../alt_cliente.php?cod=" . $_GET['cod'];
    $tipo = "Alteração";
    include_once("../conexao.php");
    $query = "SELECT * FROM cliente where cod=$cod";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $nome = $row['nome'];
    $endereco = $row['endereco'];
    $cpf = $row['cpf'];
    $telefone = $row['telefone'];
    $limite = $row['limite_cred'];
    $cidade = $row['cidade'];
    $estado = $row['estado'];
    $email = $row['email'];
    unset($_GET['cod']);
}
?>
<!DOCtype html>
<html>

<head>
    <meta charset="UTF-8">
    <title> <?= $tipo ?> de clientes </title>
    <script>
        function mascara_telefone(elem) {
            if (!elem.value) return elem.value = "";
            elem.value = elem.value.replace(/\D/g, '')
            elem.value = elem.value.replace(/(\d{2})(\d)/, "($1)$2")
            elem.value = elem.value.replace(/(\d)(\d{4})$/, "$1-$2")
        }
        
        function mascara_cpf(elem) {
            if (!elem.value) return elem.value = "";
            elem.value = elem.value.replace(/\D/g, '')
            elem.value = elem.value.replace(/(\d{3})(\d)/, "$1.$2")
            elem.value = elem.value.replace(/(\d{3})(\d)/, "$1.$2")
            elem.value = elem.value.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
        } 

        function mascara_numeros_positivos(elem) {
            elem.value = elem.value.replace(/[^\d.]/g, '');

            var numero = parseFloat(elem.value);
            if (isNaN(numero) || numero < 0) {
                elem.value = '';
            }
        }
    </script>

</head>

<body>
    <table style="background-color: lightgrey; border:1px solid black">
        <thead>
            <tr>
                <td style="border:1px solid black">
                    <p>
                    <h1>
                        <?= $tipo ?> de clientes
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
                        <p style="margin-top:10px;"> Nome:<input style="border-width: 3px;margin-left: 21px;" type="text" value='<?=$nome?>' name="nome" id="nome" size="80" maxlength="100" required>
                        </p>
                        <P> CPF:<input value='<?=$cpf?>' style="border-width: 3px; margin-left: 32px;" type="text" name="cpf" size="14" minlength="14" maxlength="14" placeholder="xxx.xxx.xxx-xx" onkeyup="mascara_cpf(this)" required></P>
                        <P> Telefone:<input value='<?=$telefone?>' onkeyup="mascara_telefone(this)" style="border-width: 3px;margin-left: 5px;" type="tel" name="telefone" size="14" minlength="14" maxlength="14" placeholder="(xx)xxxxx-xxxx" required></P>
                        <P> Email:<input value='<?=$email?>' style="border-width: 3px;margin-left: 23px;" type="email" name="email" size="14" maxlength="100" required></P>
                        <P> Limite:<input value='<?=$limite?>' style="border-width: 3px;margin-left: 19px;" type="text" placeholder="R$ 0.00" name="limite" size="14" oninput="mascara_numeros_positivos(this)" required></P>
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
                        <p> Cidade:<input value='<?=$cidade?>' style="border-width: 3px;margin-left: 21px;" type="text" size="80"
                                maxlength="80" name="cidade" required></p>
                        <p> Endereço:<input value='<?=$endereco?>' style="border-width: 3px;margin-left: 2px;" type="text" size="80"
                                maxlength="100" name="endereco" required></p>
                        <p> <input style="border-width: 3px;margin-left: 0px;" type="submit" value="Enviar">
                            <input style="border-width: 3px;margin-left: 10px;" type="reset" value="<?=$botaoreset?>">
                                 </p>
                    </form>
                </td>
            </tr>
        </tbody>
</body>
</html>