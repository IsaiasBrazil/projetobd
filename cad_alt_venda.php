<?php
$tipo = "Cadastro";
$action = "inc_venda.php";
$cod = "";
$data = "";
$prazo_entrega = "";
$cond_pagto = "";
$cod_cliente;
$cod_vendedor;
include_once('Model/venda.php');
include_once("Model/item_venda.php");

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    $action = "alt_venda.php?cod=" . $_GET['cod'];
    $tipo = "Alteração";
    include_once("conexao.php");
    $query = "SELECT * FROM venda where cod=$cod";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $data = $row['data'];
    $prazo_entrega = $row['prazo_entrega'];
    $cond_pagto = $row['cond_pagto'];
    unset($_GET['cod']);
}

if (!isset($_SESSION['cliente'])) {
    $_SESSION['cliente'] = "";
}
if (!isset($_SESSION['vendedor'])) {
    $_SESSION['vendedor'] = "";
}

if (!isset($_SESSION['produto'])) {
    $_SESSION['produto'] = "";
}

if (!isset($_SESSION['qtd'])) {
    $_SESSION['qtd'] = "1";
}

if (!isset($_SESSION['itens_venda'])) {
    $_SESSION['itens_venda'] = array();
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
            const s = document.getElementById('selecao');
            s.style.visibility = 'hidden';
        }
    </script>
</head>

<body>
    <form method="post">
        <table id="tabela" style="background-color: lightsteelblue; border:1px solid black">
            <tbody>
                <tr>
                    <td colspan="3" style="border:1px solid black">
                        <p>
                        <h1>
                            <?= $tipo ?> de vendas
                        </h1>
                        </p>
                    </td>

                    
                        <?php
                        function pesquisar($botao, $nome_tabela, $metodo)
                        {
                            if (isset($_POST[$botao])) {
                                $dadodigitado = $_POST[$nome_tabela];
                                $metodo_pesquisa = $_POST[$metodo];

                                include_once('conexao.php');

                                if ($metodo_pesquisa == 'por_nome') {
                                    $query = "SELECT cod,nome FROM $nome_tabela WHERE nome like '%$dadodigitado%'";
                                    $result = mysqli_query($con, $query);
                                    include_once("pesquisa.php");
                                    $codigo = grid($result, strtoupper("$nome_tabela"));
                                } elseif ($metodo_pesquisa == 'por_codigo') {
                                    $query = "SELECT cod,nome FROM $nome_tabela WHERE cod = $dadodigitado";
                                    $result = mysqli_query($con, $query);
                                    include_once("pesquisa.php");
                                    $codigo = grid($result, strtoupper("$nome_tabela"));
                                }

                            }

                        }
                        pesquisar('botao_pesquisa_cliente', 'cliente', 'metodo_pesquisa_cliente');
                        pesquisar('botao_pesquisa_vendedor', 'vendedor', 'metodo_pesquisa_vendedor');
                        pesquisar('botao_pesquisa_produto', 'produto', 'metodo_pesquisa_produto');
                        ?>
                
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

                        <label 
                            <?php
                                if (isset($_GET['cliente'])) 
                                    if ($_GET['cliente'] == "")
                                        unset($_GET['cliente']);
                                echo (isset($_GET['cliente']) 
                                    ? "style='color: red';" 
                                    : "style='color: black';") 
                            ?> id="lblcliente">
                            <?= 
                                isset($_GET['cliente']) 
                                ? $_GET['cliente']." selecionado(a)" 
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
                    <td>
                        <label 
                            <?php 
                                if (isset($_GET['vendedor'])) 
                                    if ($_GET['vendedor'] == "")
                                        unset($_GET['vendedor']);
                                echo (isset($_GET['vendedor']) 
                                    ? "style='color: red';" 
                                    : "style='color: black';") 
                            ?>>
                            <?= 
                                isset($_GET['vendedor']) 
                                ? $_GET['vendedor']." selecionado(a)" 
                                : "Selecione o vendedor" 
                            ?>
                        </label>
                    </td>
                    <td></td>
                    <td></td>
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

                <tr> 
                    <td colspan="3" style="height:6px"></td>
                </tr>


                <!-- Código relativo a parte da data da venda -->
                <tr>
                    <td>Data da venda:</td>
                    <td>
                        <input id="data" type="date" onchange="alert(this.value)">
                        <script>
                            elementoData = new Date;
                            elementoData.setHours(new Date().getHours() - 3);
                            var hoje = elementoData.toISOString().split('T')[0];
                            document.querySelector('#data').value = hoje;
                        </script>
                        </input>
                    </td>
                    <td>
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
                        <input style="width:80%" id="prazo_entrega" type="text" placeholder="Exemplo: Entregar em x dias...">
                        </input>
                    </td>
                </tr>
                <!-- Fim do código relativo a parte do prazo de entrega -->

                <tr> 
                    <td colspan="3" style="height:6px"></td>
                </tr>
                
                <tr>
                    <td>
                        <label>Tipo:</label>
                    </td>
                    
                    <td>
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
                        <button name="botao_pesquisa_produto">Pesquisar</button><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label id="lblproduto" style="color:red">
                            <?php 
                                echo isset($_GET['produto']) && ($_GET['produto'] != "") 
                                ? $_SESSION['qtd']."[".$_GET['produto']."] adicionado!" 
                                : "";
                            ?>
                        </label>
                    </td>
                </tr>
            </tbody>
            <tbody id="produtos" name="produtos">
                <tr>
                    <td>
                    </td>
                </tr>
            </tbody>
    </form>
</body>
</html>