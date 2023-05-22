<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$data_inicial = $_POST['data_inicial'];
$data_final = $_POST['data_final'];
$_SESSION['data_inicial'] = $data_inicial;
$_SESSION['data_final'] = $data_final;
require('fpdf185/fpdf.php');
$tabelas = array('produto', 'venda');

function gerar_relatorios($lista_tabelas)
{
    global $data_inicial, $data_final;
    require('conexao.php');
    foreach ($lista_tabelas as $tabela) {
        $nome_arq_relatorio;
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $fonte = 12;
        $pdf->SetFont('Arial', 'B', $fonte);
        $tamanhos = [15, 120, 30, 35, 35, 40]; //tamanhos de cada uma das células
        $tamanhos2 = [18, 43, 32, 32, 32, 32, 32, 55];

        if ($tabela == 'produto') {
            $nome_arq_relatorio = 'relatorio_produtos.pdf';
            $query = 'SELECT p.cod, p.nome, p.preco, p.qtd_estoque, p.unidade_medida, c.descricao FROM produto p INNER JOIN categoria c WHERE p.fk_categoria_id = c.cod GROUP BY p.cod';
            $resu = mysqli_query($con, $query);
            $qt_registros = mysqli_num_rows($resu);


            // Criando os nomes das colunas
            $pdf->Cell($tamanhos[0], 6, 'cod', 1, 0, 'C');
            $pdf->Cell($tamanhos[1], 6, 'nome', 1, 0, 'C');
            $pdf->Cell($tamanhos[2], 6, 'preco', 1, 0, 'C');
            $pdf->Cell($tamanhos[3], 6, 'qtd_estoque', 1, 0, 'C');
            $pdf->Cell($tamanhos[4], 6, 'unidade_medida', 1, 0, 'C');
            $pdf->Cell($tamanhos[5], 6, 'categoria', 1, 0, 'C');
            $pdf->Ln();

            while ($linha = mysqli_fetch_assoc($resu)) {
                $temp = 0;
                foreach ($linha as $key => &$elem) {
                    $valor = mb_convert_encoding(($linha[$key]), "utf-8", "auto");
                    $valor = str_replace('”', '"', $valor);
                    $valor = utf8_decode($valor);
                    $tamanho = strlen($valor);
                    $fonte = intval(intval($tamanhos[$temp]) * 5 / $tamanho);
                    $fonte = ($fonte <= 16 && $fonte > 0) ? $fonte : 16;
                    $pdf->SetFont('Arial', 'B', $fonte);
                    $pdf->Cell($tamanhos[$temp], 6, $valor, 1, 0, 'C');
                    $temp += 1;
                }
                $pdf->Ln();
            }
        } elseif ($tabela == 'venda') {
            $nome_arq_relatorio = 'relatorio_vendas.pdf';
            $query = "SELECT v.numero, v.data, v.prazo_entrega, v.cond_pagto, v.fk_cliente_cod, v.fk_vendedor_cod, p.cod, p.nome FROM venda v INNER JOIN itens_venda iv ON v.numero = iv.fk_vendas_numero INNER JOIN produto p ON iv.fk_produtos_cod = p.cod WHERE DATE(v.data) BETWEEN '$data_inicial' AND '$data_final'";
            $resu = mysqli_query($con, $query);
            $qt_registros = mysqli_num_rows($resu);

            // Criando os nomes das colunas
            $pdf->Cell($tamanhos2[0], 6, 'numero', 1, 0, 'C');
            $pdf->Cell($tamanhos2[1], 6, 'data', 1, 0, 'C');
            $pdf->Cell($tamanhos2[2], 6, 'prazo_entrega', 1, 0, 'C');
            $pdf->Cell($tamanhos2[3], 6, 'cond_pagto', 1, 0, 'C');
            $pdf->Cell($tamanhos2[4], 6, 'cod_cliente', 1, 0, 'C');
            $pdf->Cell($tamanhos2[5], 6, 'cod_vendedor', 1, 0, 'C');
            $pdf->Cell($tamanhos2[6], 6, 'cod_produto', 1, 0, 'C');
            $pdf->Cell($tamanhos2[7], 6, 'produto', 1, 0, 'C');
            $pdf->Ln();

            while ($linha = mysqli_fetch_assoc($resu)) {
                $temp = 0;
                foreach ($linha as $key => &$elem) {
                    $valor = mb_convert_encoding(($linha[$key]), "UTF-8", "auto");
                    $valor = str_replace('”', '"', $valor);
                    $valor = utf8_decode($valor);
                    $tamanho = strlen($valor) > 0 ? strlen($valor) : 1;
                    $fonte = intval(intval($tamanhos2[$temp]) * 5 / $tamanho);
                    $fonte = ($fonte <= 16 && $fonte > 0) ? $fonte : 16;
                    $pdf->SetFont('Arial', 'B', $fonte);
                    $pdf->Cell($tamanhos2[$temp], 6, $valor, 1, 0, 'C');
                    $temp += 1;
                }
                $pdf->Ln();
            }
        }
        $pdf->Output($nome_arq_relatorio, 'F');

    }
}
gerar_relatorios($tabelas);
?>
<!DOCTYPE html>
<style>
    a:hover {
        background-color: aquamarine;
    }

    a {
        font-size: 20px;
    }

    p {
        font-size: 22px;
        color: red;
    }
</style>
<p>Relatórios gerados:</p>
<p>
    <a href='relatorio_produtos.pdf' target="_blank">relatorio_produtos.pdf</a>
</p>
<p>
    <a href='relatorio_vendas.pdf' target="_blank">relatorio_vendas.pdf</a>
</p>