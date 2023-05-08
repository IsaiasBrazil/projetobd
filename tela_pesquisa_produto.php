<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de pesquisa dos produtos</title>
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
                    <label style="font-size: 35px;">Pesquisa produto</label><br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <select name="metodo_pesquisa_produto" class="estilo_padrao">
                        <option value="por_codigo">Por código</option>
                        <option value="por_nome">Por nome</option>
                        <option value="por_categoria_cod">Por categoria (código)</option>
                        <option value="por_categoria_desc">Por categoria (descrição)</option>
                    </select>
                    <input type="text" name="produto" id="produto" class="estilo_padrao">
                    <button name="botao_pesquisa" class="estilo_padrao">Pesquisar</button>
                    <button type="reset" class="estilo_padrao">Limpar</button>
                </td>
            </tr>
        </table>
        <?php
            function mostrar_dados_do_bd($lista_dados) {
                $qt_resultados = mysqli_num_rows($lista_dados);
                $metodo_pesquisa = $_POST['metodo_pesquisa_produto'];
                
                if ($qt_resultados > 0) {
                    while ($linha = mysqli_fetch_assoc($lista_dados)) {
                        echo "<p class='estilo_padrao'>Código: ".$linha['cod']."<br>";
                        echo "Nome: ".$linha['nome']."<br>";
                        echo "Preço: R$ ".$linha['preco']."<br>";
                        echo "Quantidade em estoque: ".$linha['qtd_estoque']."<br>";
                        echo "Unidade de medida: ".$linha['unidade_medida']."<br>";
                        echo "Código da categoria: ".$linha['fk_categoria_id']."</p><hr>";
                    }
                }
                elseif ($metodo_pesquisa == 'por_codigo') {
                    echo "<p style='color: rgb(210, 31, 60); font-size: 30px; font-weight: bold;'>Produto não encontrado!</p>";
                }
                elseif ($metodo_pesquisa == 'por_nome') {
                    echo "<p style='color: rgb(210, 31, 60); font-size: 30px; font-weight: bold;'>Produto(s) não encontrado(s)!</p>";
                }
                elseif ($metodo_pesquisa == 'por_categoria_cod') {
                    echo "<p style='color: rgb(210, 31, 60); font-size: 30px; font-weight: bold;'>Produto não encontrado!</p>";
                }
                elseif ($metodo_pesquisa == 'por_categoria_desc') {
                    echo "<p style='color: rgb(210, 31, 60); font-size: 30px; font-weight: bold;'>Produto(s) não encontrado(s)!</p>";
                }
            }

            function pesquisar_produto($input_produto, $metodo) {
                if (isset($_POST['botao_pesquisa'])) {
                    $metodo_pesquisa = $_POST[$metodo];
                    $identificacao_produto = $_POST[$input_produto];
                    include_once('conexao.php');

                    if (empty($identificacao_produto)) {
                        echo "<p style='color: rgb(218, 165, 32); font-weight: bold; font-size: 30px;'>Por favor, insira um código/nome (de produto) ou código (de categoria) para pesquisar um produto.</p>";
                    }
                    elseif (!empty($identificacao_produto) && $metodo_pesquisa == 'por_codigo' && is_numeric($identificacao_produto)) {
                        $query = "SELECT * FROM produto WHERE cod = $identificacao_produto";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        mostrar_dados_do_bd($result);
                    }
                    elseif (!empty($identificacao_produto) && $metodo_pesquisa == 'por_codigo' && !is_numeric($identificacao_produto)) {
                        echo "<p style='color: rgb(152, 103, 197); font-weight: bold; font-size: 30px;'>Foi digitado um nome ao invés de um código, insira a informação novamente.</p>";
                    }
                    elseif (!empty($identificacao_produto) && $metodo_pesquisa == 'por_nome' && is_numeric($identificacao_produto)) {
                        echo "<p style='color: rgb(0, 206, 209); font-weight: bold; font-size: 30px;'>Foi digitado um código ao invés de um nome, insira a informação novamente.</p>";
                    }
                    elseif (!empty($identificacao_produto) && $metodo_pesquisa == 'por_nome' && !is_numeric($identificacao_produto)) {
                        $query = "SELECT * FROM produto WHERE nome like '%$identificacao_produto%'";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        mostrar_dados_do_bd($result);
                    }
                    elseif (!empty($identificacao_produto) && $metodo_pesquisa == 'por_categoria_cod' && is_numeric($identificacao_produto)) {
                        $query = "SELECT p.cod, p.nome, p.preco, p.qtd_estoque, p.unidade_medida, p.fk_categoria_id FROM produto p INNER JOIN categoria c WHERE p.fk_categoria_id = c.cod AND p.fk_categoria_id = $identificacao_produto";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        mostrar_dados_do_bd($result);
                    }
                    elseif (!empty($identificacao_produto) && $metodo_pesquisa == 'por_categoria_cod' && !is_numeric($identificacao_produto)) {
                        echo "<p style='color: rgb(176, 101, 0); font-weight: bold; font-size: 30px;'>Foi digitado um nome ao invés de um código de categoria, insira a informação novamente.</p>";
                    }
                    elseif (!empty($identificacao_produto) && $metodo_pesquisa == 'por_categoria_desc' && is_numeric($identificacao_produto)) {
                        echo "<p style='color: rgb(255, 0, 127); font-weight: bold; font-size: 30px;'>Foi digitado um código de categoria ao invés de uma descrição, insira a informação novamente.</p>";
                    }
                    elseif (!empty($identificacao_produto) && $metodo_pesquisa == 'por_categoria_desc' && !is_numeric($identificacao_produto)) {
                        $query = "SELECT p.cod, p.nome, p.preco, p.qtd_estoque, p.unidade_medida, p.fk_categoria_id FROM produto p INNER JOIN categoria c WHERE p.fk_categoria_id = c.cod AND c.descricao like '%$identificacao_produto%'";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        mostrar_dados_do_bd($result);
                    }
                }
            }
            pesquisar_produto('produto', 'metodo_pesquisa_produto');
        ?>
    </form>
</body>
</html>