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
            function mostrar_dados_do_bd($lista_dados) {
                $qt_resultados = mysqli_num_rows($lista_dados);

                if ($qt_resultados > 0) {
                    while ($linha = mysqli_fetch_assoc($lista_dados)) {
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
                else {
                    echo "<p style='color: rgb(210, 31, 60); font-size: 30px; font-weight: bold;'>Cliente(s) não encontrado(s)!</p>";
                }
            }

            function pesquisar_cliente($input_cliente, $metodo) {
                if (isset($_POST['botao_pesquisa'])) {
                    $metodo_pesquisa = $_POST[$metodo];
                    $identificacao_cliente = $_POST[$input_cliente];
                    include_once('conexao.php');

                    if (empty($identificacao_cliente)) {
                        echo "<p style='color: rgb(218, 165, 32); font-weight: bold; font-size: 30px;'>Por favor, insira um código ou nome para pesquisar um cliente.</p>";
                    }
                    elseif (!empty($identificacao_cliente) && $metodo_pesquisa == 'por_codigo' && is_numeric($identificacao_cliente)) {
                        $query = "SELECT * FROM cliente WHERE cod = $identificacao_cliente";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        mostrar_dados_do_bd($result);
                    }
                    elseif (!empty($identificacao_cliente) && $metodo_pesquisa == 'por_codigo' && !is_numeric($identificacao_cliente)) {
                        echo "<p style='color: rgb(152, 103, 197); font-weight: bold; font-size: 30px;'>Foi digitado um nome ao invés de um código, insira a informação novamente.</p>";
                    }
                    elseif (!empty($identificacao_cliente) && $metodo_pesquisa == 'por_nome' && is_numeric($identificacao_cliente)) {
                        echo "<p style='color: rgb(0, 206, 209); font-weight: bold; font-size: 30px;'>Foi digitado um código ao invés de um nome, insira a informação novamente.</p>";
                    }
                    elseif (!empty($identificacao_cliente) && $metodo_pesquisa == 'por_nome' && !is_numeric($identificacao_cliente)) {
                        $query = "SELECT * FROM cliente WHERE nome like '%$identificacao_cliente%'";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        mostrar_dados_do_bd($result);
                    }
                }
            }
            pesquisar_cliente('cliente', 'metodo_pesquisa_cliente');
        ?>
    </form>
</body>
</html>