<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
function grid($result, $tipo)
{
    $fields = mysqli_fetch_fields($result);
    global $cod;
    global $nome;
    ?>
    <p>
    <h2>
        LISTA DE
        <?= $tipo ?>
    </h2>
    </p>
    <table border="3px">
        <tr>
            <?php
            foreach ($fields as $field) {
                ?>
                <th>
                    <?php echo $field->name; ?>
                </th>
                <?php
            }
            ?>

            <th>
                <?php echo "opções"; ?>
            </th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
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
                    $produto = $nome;
                    echo "<td><a href=\"cad_alt_venda.php?vendedor=$vendedor&cliente=$cliente&produto=$produto\"\">Selecionar produto</a></td>";
                    echo "<td><a href=\"cad_alt_venda.php?vendedor=$vendedor&cliente=$cliente\" onclick=\"sumir('" . $nome . "','" . $nomecampo . "');\">Fechar</a></td>";
               
                } else {
                    $produto = isset($_GET['produto']) ? $_GET['produto'] : "";
                    echo "<td><a href=\"cad_alt_venda.php?vendedor=$vendedor&cliente=$cliente&produto=$produto\" onclick=\"sumir('" . $nome . "','" . $nomecampo . "');\">Selecionar</a></td>";
                }
               
                            
                ?>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php return $nome;
} ?>