<?php
function grid($result, $tipo)
{
    $fields = mysqli_fetch_fields($result);
  
    ?>
    <p>
        <h3>
            LISTA DE <?=$tipo?>
        </h3>
    </p>
    <table width ="100%" border="3px">
        <tr>
            <?php
            foreach ($fields as $field) {
                $nomecampo = $field->name;
                    //aqui substitui alguns nomes de campo do bd como exemplo fk_categoria_id para código de categoria
                    if($nomecampo=="fk_categoria_id") $nomecampo = "código de categoria";
                    if($nomecampo=="qtd_estoque") $nomecampo = "quantidade em estoque";
                    if($nomecampo=="cod") $nomecampo = "código";
                    if($nomecampo=="unidade_medida") $nomecampo = "unidade de medida";
                    if($nomecampo =="porc_comissao") $nomecampo = "percentual de comissão";
                ?>
                <th>
                    <?php echo $nomecampo; ?>
                </th>
                <?php
            }
            ?>
            
            <th>
                    <?php echo "opções"; ?>
            </th>
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
                    $cod;                    
                    $nomecampo = $field->name;
                    $valor = $row[$nomecampo];
                    if ($nomecampo == "cod") {
                        $cod = $valor;
                    }
                    ?>
                    <td>
                        <input size="<?php echo strlen($nomecampo)+1; ?>" type="text" value="<?= $valor ?>">
                    </td>
                    <?php
                }
                    $nometabela = $field->table;
                    echo "<td><a href='cad_alt_".$nometabela.".php?cod=$cod'>Alterar</a></td>";
                    echo " <td><a href='del_".$nometabela.".php?cod=$cod'>Excluir</a></td>";
                ?>
            </tr>
            <?php
        }
        ?>
    </table>
    <a href="cad_alt_<?=$field->table?>.php">Voltar</a></td>
           
<?php } ?>