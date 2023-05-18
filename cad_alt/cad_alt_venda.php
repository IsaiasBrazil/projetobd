<?php
require_once('../Model/venda.php');
require_once('../Model/item_venda.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$tipo = "Cadastro";
$action = "inc_venda.php";
$data = "";
$cond_pagto = "";
$cod_cliente;
$cod_vendedor;
$codigo;
$produto;
$qtd;

if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    $action = "alt_venda.php?cod=" . $_GET['cod'];
    $tipo = "Alteração";
    require_once("conexao.php");
    $query = "SELECT * FROM venda where cod=$cod";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $data = $row['data'];
    $prazo_entrega = $row['prazo_entrega'];
    $cond_pagto = $row['cond_pagto'];
    unset($_GET['cod']);
}



if (!isset($_SESSION['produto'])) {
    $_SESSION['produto'] = "";
}

if (!isset($_SESSION['qtd'])) {
    if (isset($_POST['qtd']))
        $_SESSION['qtd'] = $_POST['qtd'];
}

?>
<!DOCtype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        <?= $tipo ?> de vendas
    </title>

    <script>
        function sumir(nome, tabela) {
            s = document.getElementById('selecao');
            s.style.visibility = 'hidden';
            s = null;
        }
    </script>

</head>

<body>
    <form method="POST" action="../controle_form.php">
        <table id="tabela" style="background-color: lightsteelblue; border:1px solid black">
            <tbody>
                <tr>
                    <th colspan="4" style="border:1px solid black">
                        <h1>
                            <?= $tipo ?> de vendas
                        </h1>

                        <?php
                        if (!isset($_SESSION['prazo_entrega'])) {
                            $_SESSION['prazo_entrega'] = '';
                        }

                        if (isset($_POST['prazo_entrega'])) {
                            $_SESSION['prazo_entrega'] = $_POST['prazo_entrega'];
                        }

                        // foreach($_POST as $post){
                        //     echo "<script>alert('" .$post. "');</script>";
                        
                        // }
                        require_once('../pesquisa.php');
                        $_SESSION['cod_cliente'] = pesquisar('botao_pesquisa_cliente', 'cliente', 'metodo_pesquisa_cliente');
                        $_SESSION['cod_vendedor'] = pesquisar('botao_pesquisa_vendedor', 'vendedor', 'metodo_pesquisa_vendedor');
                        pesquisar('botao_pesquisa_produto', 'produto', 'metodo_pesquisa_produto');
                        ?>
                    </th>
                </tr>
                <!-- Código relativo a parte do cliente -->
                <tr>
                    <td>
                        <?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?>

                        <label <?php
                        if (isset($_GET['cliente']))
                            if ($_GET['cliente'] == "")
                                unset($_GET['cliente']);
                            else
                                $_SESSION['cliente'] = $_GET['cliente'];
                        echo (isset($_SESSION['cliente'])
                            ? "style='color: red';"
                            : "style='color: black';")
                            ?> id="lblcliente">
                            <?=
                                isset($_SESSION['cliente'])
                                ? $_SESSION['cliente'] . " selecionado(a)"
                                : "Selecione o cliente"
                                ?>
                        </label>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="metodo_pesquisa_cliente">
                            <option value="por_nome">Por nome</option>
                            <option value="por_codigo">Por código</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="cliente" id="cliente">
                    </td>
                    <td>
                        <button name="botao_pesquisa_cliente">Pesquisar</button><br>
                    </td>
                </tr>
                <!-- Fim do código relativo a parte do cliente -->


                <!-- Código relativo a parte do vendedor -->
                <tr>
                    <td colspan="3">
                        <label <?php
                        if (isset($_GET['vendedor'])) {
                            if ($_GET['vendedor'] == "") {
                                unset($_GET['vendedor']);
                            } else {
                                $_SESSION['vendedor'] = $_GET['vendedor'];

                            }
                        }
                        if (isset($_SESSION['vendedor']))
                            echo "style='color: red';";
                        else
                            echo "style='color: black';";
                        ?>>
                            <?=
                                isset($_SESSION['vendedor'])
                                ? $_SESSION['vendedor'] . " selecionado(a)"
                                : "Selecione o vendedor"
                                ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="metodo_pesquisa_vendedor">
                            <option value="por_nome">Por nome</option>
                            <option value="por_codigo">Por código</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="vendedor" id="vendedor">
                    </td>
                    <td>
                        <button name="botao_pesquisa_vendedor">Pesquisar</button><br>
                    </td>
                </tr>
                <!-- Fim do código relativo a parte do vendedor -->

                <!-- Pula uma linha -->
                <tr>
                    <td colspan="3" style="height:6px"></td>
                </tr>
                <!-- Terminou de pular uma linha -->

                <!-- Código relativo a parte da data da venda -->
                <tr>

                    <td>Data da venda:</td>
                    <?php
                    if (!isset($_SESSION['data'])) {
                        $_SESSION['data'] = '';
                        if (isset($_POST['data'])) {
                            $_SESSION['data'] = $_POST['data'];
                            echo $_SESSION['data'];
                        }
                    }
                    ?>
                    <td colspan="2">
                        <input name="data" id="data" type="date" value=<?= $_SESSION['data'] ?>>
                        <script>
                            if (document.querySelector('#data').value == "") {
                                elementoData = new Date;
                                elementoData.setHours(new Date().getHours() - 3);
                                var hoje = elementoData.toISOString().split('T')[0];
                                document.querySelector('#data').value = hoje;
                            }
                        </script>
                        </input>
                    </td>
                </tr>
                <!-- Fim do código relativo a parte da data da venda -->

                <tr>
                    <td colspan="3" style="height:6px"></td>
                </tr>


                <!-- Código relativo a parte do prazo de entrega -->
                <tr>
                    <td>Prazo de entrega:</td>
                    <td colspan="2">
                        <input style="width:97%" id="prazo_entrega" name="prazo_entrega" type="text"
                            value=<?= $_SESSION['prazo_entrega']; ?> placeholder="Exemplo: Entregar em x dias...">
                        </input>
                    </td>
                </tr>
                <!-- Fim do código relativo a parte do prazo de entrega -->

                <tr>
                    <td colspan="3" style="height:6px"></td>
                </tr>
                <tr>
                    <td>
                        <label>Forma de pagamento:</label>
                    </td>
                    <td colspan="2">
                        <?php
                        if (!isset($_SESSION['cond_pagto'])) {
                            $_SESSION['cond_pagto'] = '';
                            if (isset($_POST['cond_pagto'])) {
                                $_SESSION['cond_pagto'] = $_POST['cond_pagto'];
                            }
                        }
                        ?>

                        <select name="cond_pagto" id="">
                            <option value="cartao" <?= ($_SESSION['cond_pagto'] == 'cartao') ? 'selected' : '' ?>>Cartão de crédito</option>
                            <option value="pix" <?= ($_SESSION['cond_pagto'] == 'pix') ? 'selected' : '' ?>>Pix</option>
                            <option value="boleto" <?= ($_SESSION['cond_pagto'] == 'boleto') ? 'selected' : '' ?>>Boleto</option>
                            <option value="dinheiro" <?= ($_SESSION['cond_pagto'] == 'dinheiro') ? 'selected' : '' ?>>Dinheiro</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="height:6px"></td>
                </tr>

                <tr>

                    <td colspan="2">
                        <label>Selecione o produto:</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="metodo_pesquisa_produto">
                            <option value="por_nome">Por nome</option>
                            <option value="por_codigo">Por código</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="produto" id="produto">
                    </td>
                    <td>
                        <button name="botao_pesquisa_produto">Pesquisar</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="color:red">
                        <label id="lblproduto" style="color:red">
                            <?php
                            if (isset($_POST['prod']) && isset($_POST['qtd']) && isset($_POST['prod_codigo'])) {
                                $qtd = $_POST['qtd'];
                                $produto = $_POST['prod'];
                                $codigo = $_POST['prod_codigo'];
                                unset($_POST['qtd']);
                                unset($_POST['prod']);
                                unset($_POST['prod_codigo']);
                                $mensa = $qtd . " [" . $produto . "] adicionado!";
                                echo $mensa;
                                $mensa = null;
                                unset($_GET['mensa']);
                            } elseif (isset($_SESSION['mensa'])) {
                                $mensa = $_SESSION['mensa'] . " excluído!";
                                echo $mensa;
                                unset($_SESSION['mensa']);
                                $mensa = null;
                            } else {
                                echo "&nbsp;";
                            }
                            ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td style="width: auto;" colspan="3">
                        <div id="scroll_produtos" style="overflow:auto;height:300px">
                            <table width="auto" id="tabela_produtos" style="background-color:white;">
                                <thead>
                                    <tr style="background-color:black;color:white;">
                                        <th colspan="4">
                                            LISTA DE PRODUTOS
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                    </tr>
                                    <tr style="background-color:lightgrey;">
                                        <th>Descrição: </th>
                                        <th>Quantidade: </th>
                                        <th>Cod produto: </th>
                                        <th>Opção: </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <?php
                                        if (isset($codigo) && isset($produto) && isset($qtd)) {
                                            if (!isset($_SESSION['itens_venda'])) {
                                                $_SESSION['itens_venda'] = array();
                                            }
                                            $itemvenda = array($produto, intval($qtd), intval($codigo));
                                            $temp = $_SESSION['itens_venda'];
                                            $encontrado = false;
                                            foreach ($temp as $key => $prod) {
                                                if ($prod[2] == $codigo) {
                                                    $_SESSION['itens_venda'][$key][1] = intval($qtd) + $_SESSION['itens_venda'][$key][1];
                                                    $encontrado = true;
                                                    break;
                                                }
                                            }
                                            $temp = null;
                                            if (!$encontrado)
                                                array_push($_SESSION['itens_venda'], $itemvenda);
                                        }
                                        if (isset($_SESSION['itens_venda'])) {
                                            $color = "yellow";
                                            foreach ($_SESSION['itens_venda'] as $key => &$item) {
                                                $color = $color == "yellow" ? "lightgreen" : "yellow";
                                                echo "<tr style=\"background-color:$color\">";
                                                echo '<td>' . $item[0] . '</td>' . '<td>' . $item[1] . '</td>' . '<td>' . $item[2] . '</td>';
                                                echo "<td><a href='del_produto_venda.php?key=$key' target='tela'>excluir</a></td>";
                                                echo '</tr>';
                                            }
                                        } else {
                                            // echo "<td>else</td>";
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <script>
                            const scrollProdutos = document.getElementById('scroll_produtos');
                            max = scrollProdutos.scrollHeight;
                            scrollProdutos.scrollTop = max;
                        </script>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input name="btnlimpar" type="submit" value="limpar tudo">
                    </td>
                    <td>
                        <button name="btnfinalizar" value="finalizar">Finalizar venda</button>

                        <?php
                        if (isset($_POST['btnfinalizar'])) {
                            // echo "<script>alert('alert');</script>";
                            require_once("../finalizar_venda.php");
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
</body>

</html>