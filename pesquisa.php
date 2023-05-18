<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
function grid($result, $tipo)
{
    $fields = mysqli_fetch_fields($result);
    global $cod;
    global $nome;
    global $qtd;
    $tamanho = mysqli_num_rows($result);
    ?>
    <style>
        .tabela_branca {
            border-collapse: collapse;

        }

        .tabela_branca td,
        th {
            border: 3px solid grey;
            background-color: lightstellblue;
            //border-collapse: collapse;
        }
    </style>
    <th id="selecao" rowspan='15' style="width:600px;">
        <h2 style="text-align: center;">
            SELEÇÃO DE
            <?= $tipo ?>
        </h2>
        <div style="overflow-y: auto; background-color: lightstellblue;height: 500px;width: auto;">

            <table class="tabela_branca">
                <tr>
                    <?php
                    foreach ($fields as $field) {
                        ?>
                        <th>
                            <?php echo $field->name; ?>
                        </th>
                        <?php

                    }
                    if ($tipo == 'PRODUTO') { ?>
                        <th>
                            <?php echo "quantidade"; ?>
                        </th>
                        <?php
                    }

                    ?>

                    <th>
                        <?php echo "opções"; ?>
                    </th>
                </tr>
                <?php
                $tamanho = -2;
                while ($row = mysqli_fetch_assoc($result)) {
                    $tamanho++;
                    ?>
                    <tr rowspan=<?= $tamanho ?>>
                        <?php
                        foreach ($fields as $field) {

                            if ($field->name == "cod") {
                                $cod = $row[$field->name];
                                $cod = $row['cod'];
                            }

                            if ($field->name == "nome") {
                                $nome = $row[$field->name];
                                $nome = $row['nome'];
                            }
                            ?>
                            <td>
                                <input size="<?php echo strlen($row[$field->name]); ?>" type="text"
                                    value="<?php echo $row[$field->name]; ?>">
                            </td>
                            <?php
                        }

                        $nomecampo = $field->table;
                        if ($nomecampo == 'cliente') {
                            $cliente = $nome;

                        } else {

                            $cliente = isset($_GET['cliente']) ? $_GET['cliente'] : "";
                        }

                        if ($nomecampo == 'vendedor') {
                            $vendedor = $nome;
                        } else {
                            $vendedor = isset($_GET['vendedor']) ? $_GET['vendedor'] : "";
                        }

                        if ($nomecampo == 'produto') {
                            $prod = $nome;
                        }

                        if ($tipo == 'PRODUTO') {
                            ?>
                            <td>
                                <form method="POST" action="#">
                                    <input type="number" id="qtd" name="qtd" value="1" min="1"
                                        onchange="verificaDisponibilidade(this);">
                                    <input type="hidden" name="vendedor" value="<?= $vendedor ?>" />
                                    <input type="hidden" name="cliente" value="<?= $cliente ?>" />
                                    <input type="hidden" name="prod" value="<?= $prod ?>" />
                                    <input type="hidden" name="prod_codigo" value="<?= $cod ?>" />
                            </td>
                            <td>
                                <input type='submit' value='Selecionar produto'>
                            </td>
                            </form>
                            <?php
                            unset($_POST);
                        } else {
                            $prod = isset($_GET['produto']) ? $_GET['produto'] : "";
                            echo "<td><a href=\"cad_alt/cad_alt_venda.php?vendedor=$vendedor&cliente=$cliente&produto=$prod\" onclick=\"sumir('" . $nome . "','" . $nomecampo . "');\">Selecionar</a></td>";
                        }
                        if (isset($_SESSION['cliente'])) {
                            unset($_SESSION['cliente']);
                            $_SESSION['cliente'] = $cliente;
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
                echo "<button style='width:127px;' onclick=\"sumir('" . $nome . "','" . $nomecampo . "');window.location.href='cad_alt/cad_alt_venda.php?vendedor=" . $vendedor . '&' . "cliente=" . $cliente . "';\" >Fechar</button>";
                ?>
            </p>

        </div>
    </th>
    <?php return $cod;
} ?>