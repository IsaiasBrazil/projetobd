<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
function verificaDisponibilidade($cod): int
{
    require('conexao.php');
    $query = "SELECT qtd_estoque FROM produto WHERE cod='$cod'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $qtd = $row['qtd_estoque'] ?? 0;
    mysqli_close($con);
    $sqtd = $_SESSION['itens_venda'][1][$cod] ?? 0;
    $qtd -= $sqtd;
    return $qtd;
}
function pesquisar($botao, $nome_tabela, $metodo)
{
    global $codigo;
    if (isset($_POST[$botao])) {
        $dadodigitado = $_POST[$nome_tabela];
        $metodo_pesquisa = $_POST[$metodo];
        unset($_POST[$botao]);
        require_once('../conexao.php');
        if ($metodo_pesquisa == 'por_nome') {
            $query = "SELECT cod,nome FROM $nome_tabela WHERE nome like '%$dadodigitado%'";
            $result = mysqli_query($con, $query);
            $codigo = grid($result, strtoupper("$nome_tabela"));
        } elseif ($metodo_pesquisa == 'por_codigo') {
            $query = "SELECT cod,nome FROM $nome_tabela WHERE cod = $dadodigitado";
            $result = mysqli_query($con, $query);
            $codigo = grid($result, strtoupper("$nome_tabela"));
        }
        mysqli_close($con);
    }
    return $codigo;
}
function grid($result, $tipo)
{
    $fields = mysqli_fetch_fields($result);
    global $cod;
    global $nome;
    global $qtd;
    global $cod_cliente;
    global $cod_vendedor;
    ?>
    <style>
        .tabela_ltblue {
            border-collapse: collapse;

        }

        .tabela_ltblue td,
        th {
            border: 3px solid grey;
            background-color: lightstellblue;
            text-overflow: clip;
        }

        #divselecao {
            overflow: auto;
            background-color: lightstellblue;
            height: 500px;
            width: 670px;

        }

        input[type='number'] {
            width: 80px;
        }

        input[type='text'] {
            width: fit-content;
        }
    </style>
    <th id="selecao" rowspan='16'>
        <h2 style="text-align: center;">
            SELEÇÃO DE
            <?= $tipo ?>
        </h2>
        <div id="divselecao">

            <table class="tabela_ltblue">
                <tr>
                    <?php
                    foreach ($fields as $field) {
                        echo "<th>{$field->name}</th>";
                    }
                    if ($tipo == 'PRODUTO') {
                        echo "<th>quantidade</th>";
                    }
                    echo "<th>opções</th>";
                    ?>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <?php
                        foreach ($fields as $field) {
                            if ($field->name == "numero") {
                                $cod = $row[$field->name];
                                $cod = $row['numero'];
                            }
                            if ($field->name == "cod") {
                                $cod = $row[$field->name];
                                $cod = $row['cod'];
                            }


                            if ($field->name == "nome") {
                                $nome = $row[$field->name];
                                $nome = $row['nome'];
                            }

                            if ($field->name == "qtd_estoque") {
                                $qtd = $row[$field->name];
                                $qtd = $row['qtd_estoque'];
                            }
                            ?>
                            <td>
                                <input type="text" value="<?= $row[$field->name]; ?>" readonly>
                            </td>
                            <?php
                        }

                        $nomecampo = $field->table;
                        if ($nomecampo == 'cliente') {
                            $cliente = $nome;
                            $cod_cliente = $cod;

                        } else {
                            $cliente = isset($_GET['cliente']) ? $_GET['cliente'] : "";
                        }

                        if ($nomecampo == 'vendedor') {
                            $vendedor = $nome;
                            $cod_vendedor = $cod;
                        } else {
                            $vendedor = isset($_GET['vendedor']) ? $_GET['vendedor'] : "";
                        }

                        if ($nomecampo == 'produto') {
                            $prod = $nome;
                        }
                        $qtd = verificaDisponibilidade($cod);
                        if ($tipo == 'PRODUTO') {
                            ?>
                            <td>
                                <form method="POST">
                                    <input type="number" id="qtd" name="qtd" value="<?= $qtd ?>" max="<?= $qtd ?>" min="0">
                                    <input type="hidden" name="vendedor" value="<?= $vendedor ?>" />
                                    <input type="hidden" name="cliente" value="<?= $cliente ?>" />
                                    <input type="hidden" name="prod" value="<?= $prod ?>" />
                                    <input type="hidden" name="prod_codigo" value="<?= $cod ?>" />
                            </td>
                            <td>
                                <input name="sel_produto" type='submit' value='Selecionar produto'>
                            </td>
                            </form>
                            <?php
                        } else {
                            $prod = isset($_GET['produto']) ? $_GET['produto'] : "";
                            echo "<td><a href=\"cad_alt_venda.php?vendedor=$vendedor&cliente=$cliente&cod_vendedor=$cod_vendedor&cod_cliente=$cod_cliente\" onclick=\"sumir('" . $nome . "','" . $nomecampo . "');\">Selecionar</a></td>";
                        }

                        if (isset($_SESSION['mensa'])) {
                            unset($_SESSION['mensa']);
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <p style="text-align: right; margin-right: 2px;">
                <?php
                echo "<button style='width:127px;' onclick=\"sumir('" . $nome . "','" . $nomecampo . "');window.location.href='cad_alt_venda.php';\" >Fechar</button>";
                ?>
            </p>

        </div>
    </th>
    <?php

    return $cod;
}
if (isset($_POST['data'])) {
    $_SESSION['data'] = $_POST['data'];
}
if (isset($_POST['cond_pagto'])) {
    $_SESSION['cond_pagto'] = $_POST['cond_pagto'];
}

?>