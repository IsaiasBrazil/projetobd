<?php
function grid($result, $tipo)
{
    global $cod;
    $fields = mysqli_fetch_fields($result);
    ?>
    <style>
        table {
            border: 1px solid black;
            border-spacing: 0px;
        }

        tr {}

        th,
        td {
            width: fit-content;
            border: 1px solid black;
            text-align: center;
        }

        h3 {
            width: fit-content;
            text-align: center;
        }
    </style>
    <table>
        <tr>
            <th colspan="<?= count($fields) + 2; ?>">
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'] . "<br>";
                    unset($_SESSION['msg']);
                }
                ?>
                <p>
                <h3>
                    LISTA DE
                    <?= $tipo ?>
                </h3>
                </p>
            </th>
        </tr>
        <tr>
            <?php
            foreach ($fields as $field) {
                $nomecampo = $field->name;
                $nometabela = $field->orgtable;
                //aqui substitui alguns nomes de campo do bd como exemplo fk_categoria_id para código de categoria
                if ($nomecampo == "fk_categoria_id")
                    $nomecampo = "código de categoria";
                if ($nomecampo == "qtd_estoque")
                    $nomecampo = "quantidade em estoque";
                if ($nomecampo == "cod")
                    $nomecampo = "código";
                if ($nomecampo == "unidade_medida")
                    $nomecampo = "unidade de medida";
                if ($nomecampo == "porc_comissao")
                    $nomecampo = "percentual de comissão";
                if ($nomecampo == "descricao")
                    $nomecampo = "categoria";

                echo "<th>" . $nomecampo . "</th>";
            }
            if (!isset($_SESSION['lista_produtos_venda'])) {

                echo "  <th>opções</th>";

                echo "<th>opções</th>";
            }
            ?>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <?php
                $nome = "";
                foreach ($fields as $field) {
                    $cod;
                    $nomecampo = $field->name;
                    $valor = $row[$nomecampo];
                    if ($nomecampo == "cod") {
                        $cod = $valor;
                    }
                    if ($nomecampo == "numero") {
                        $cod = $valor;
                    }
                    if ($nomecampo === "nome") {
                        $nome = $valor;
                    }
                    if ($nomecampo == "descricao") {
                        $nome = $valor;
                    }
                    ?>
                    <td>
                        <input type="text" value="<?= $valor ?>" readonly>
                    </td>
                    <?php
                }
                if (!isset($_SESSION['lista_produtos_venda'])) {
                    if ($tipo !== 'VENDAS') {
                        echo "<td><a href='../cad_alt/cad_alt_" . $nometabela . ".php?cod=$cod&nome=$nome'>Alterar</a></td>";
                        // echo "<td><a target='_blank' href='../cad_alt/cad_alt_" . $nometabela . ".php?cod=$cod&nome=$nome'>Alterar</a></td>";
                    }else
                        echo "<td><a href='../lista/lista_produto.php?cod=$cod'>Listar produtos da venda</a></td>";
                    echo " <td><a href='../del/del_" . $nometabela . ".php?cod=$cod&nome=$nome'>Excluir</a></td>";
                }
                ?>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
    if (!isset($_SESSION['lista_produtos_venda']))
        echo "<a href='lista_" . $nometabela . ".php'>Voltar</a></td>";
    else {
        echo "<a href='" . $_SERVER['HTTP_REFERER'] . "'>Voltar</a></td>";
        unset($_SESSION['lista_produtos_venda']);
    }
    return $cod;
}
?>