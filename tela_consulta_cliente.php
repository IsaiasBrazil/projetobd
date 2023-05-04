<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de consulta dos clientes</title>
    <!-- Parte de estilização da página  -->
    <style>
        .estilo_padrao {
            font-size: 26px;
        }
    </style>
</head>
<body>
    <form method="POST">
        <table style="border: 2px solid black;" class="estilo_padrao">
            <tr>
                <td>
                    <label style="font-size: 35px;">Pesquisa cliente</label><br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <select name="metodo_pesquisa_cliente" class="estilo_padrao">
                        <option value="por_codigo">Por código</option>
                        <option value="por_nome">Por nome</option>
                    </select>
                    <input type="text" name="cliente" id="cliente" class="estilo_padrao">
                    <button name="botao_pesquisa" class="estilo_padrao">Pesquisar</button>
                    <button type="reset" class="estilo_padrao">Limpar</button>
                </td>
            </tr>
        </table>
        <?php
            function pesquisar_cliente($input_cliente, $metodo) {
                if (isset($_POST['botao_pesquisa'])) {
                    include_once('conexao.php');
                    $metodo_pesquisa = $_POST[$metodo];
                    $identificacao_cliente = $_POST[$input_cliente];
                    //$result;

                    if ($metodo_pesquisa == 'por_codigo') {
                        $query = "SELECT * FROM cliente WHERE cod = $identificacao_cliente";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    }
                    elseif ($metodo_pesquisa == 'por_nome') {
                        $query = "SELECT * FROM cliente WHERE nome like '%$identificacao_cliente%'";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    }

                    while ($linha = mysqli_fetch_assoc($result)) {
                        echo "<p class='estilo_padrao'>Código: ".$linha['cod']."<br>";
                        echo "Nome: ".$linha['nome']."<br>";
                        echo "Endereço: ".$linha['endereco']."<br>";
                        echo "Telefone: ".$linha['telefone']."<br>";
                        echo "Limite de crédito: R$ ".$linha['limite_cred']."<br>";
                        echo "Cidade: ".$linha['cidade']."<br>";
                        echo "E-mail: ".$linha['email']."<br>";
                        echo "CPF: ".$linha['cpf']."<br>";
                        echo "Estado: ".$linha['estado']."<p/><hr>";
                    }
                }
            }
            pesquisar_cliente('cliente', 'metodo_pesquisa_cliente');
        ?>
    </form>
</body>
</html>