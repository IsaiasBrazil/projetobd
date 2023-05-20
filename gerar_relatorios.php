<?php
    require('fpdf185/fpdf.php');
    $tabelas = array('produto', 'venda');

    function gerar_relatorios($lista_tabelas) {
        require('conexao.php');

        foreach ($lista_tabelas as $tabela) {
            $nome_arq_relatorio;
            $pdf = new FPDF('L', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 14);

            if ($tabela == 'produto') {
                $nome_arq_relatorio = 'relatorio_produtos.pdf';
                $query = 'SELECT p.cod, p.nome, p.preco, p.qtd_estoque, p.unidade_medida, c.descricao FROM produto p INNER JOIN categoria c WHERE p.fk_categoria_id = c.cod GROUP BY p.cod';
                $resu = mysqli_query($con, $query);
                $qt_registros = mysqli_num_rows($resu);

                // Criando os nomes das colunas
                $pdf->Cell(15, 6, 'cod', 1, 0, 'C');
                $pdf->Cell(110, 6, 'nome', 1, 0, 'C');
                $pdf->Cell(40, 6, 'preco', 1, 0, 'C');
                $pdf->Cell(35, 6, 'qtd_estoque', 1, 0, 'C');
                $pdf->Cell(42, 6, 'unidade_medida', 1, 0, 'C');
                $pdf->Cell(42, 6, 'categoria', 1, 0, 'C');
                $pdf->Ln();

                $i = 0;
                while ($linha = mysqli_fetch_assoc($resu)) {
                    $nome = str_replace('”', '"', $linha['nome']);
                    $nome = utf8_decode($nome);
                    $descricao = utf8_decode($linha['descricao']);
                    $pdf->Cell(15, 6, $linha['cod'], 1, 0, 'C');
                    $pdf->Cell(110, 6, $nome, 1, 0, 'C');
                    $pdf->Cell(40, 6, $linha['preco'], 1, 0, 'C');
                    $pdf->Cell(35, 6, $linha['qtd_estoque'], 1, 0, 'C');
                    $pdf->Cell(42, 6, $linha['unidade_medida'], 1, 0, 'C');
                    $pdf->Cell(42, 6, $descricao, 1, 0, 'C');
                    $pdf->Ln();

                    $i++;
                }
            }

            elseif ($tabela == 'venda') {
                $nome_arq_relatorio = 'relatorio_vendas.pdf';
                $query = 'SELECT v.numero, v.data, v.prazo_entrega, v.cond_pagto, v.fk_cliente_cod, v.fk_vendedor_cod, p.cod, p.nome FROM venda v INNER JOIN itens_venda iv ON v.numero = iv.fk_vendas_numero INNER JOIN produto p ON iv.fk_produtos_cod = p.cod';
                $resu = mysqli_query($con, $query);
                $qt_registros = mysqli_num_rows($resu);

                // Criando os nomes das colunas
                $pdf->Cell(25, 6, 'numero', 1, 0, 'C');
                $pdf->Cell(30, 6, 'data', 1, 0, 'C');
                $pdf->Cell(40, 6, 'prazo_entrega', 1, 0, 'C');
                $pdf->Cell(35, 6, 'cond_pagto', 1, 0, 'C');
                $pdf->Cell(34, 6, 'cod_cliente', 1, 0, 'C');
                $pdf->Cell(36, 6, 'cod_vendedor', 1, 0, 'C');
                $pdf->Cell(34, 6, 'cod_produto', 1, 0, 'C');
                $pdf->Cell(48, 6, 'produto', 1, 0, 'C');
                $pdf->Ln();

                $i = 0;
                while ($linha = mysqli_fetch_assoc($resu)) {
                    $pdf->Cell(25, 6, $linha['numero'], 1, 0, 'C');
                    $pdf->Cell(30, 6, $linha['data'], 1, 0, 'C');
                    $pdf->Cell(40, 6, $linha['prazo_entrega'], 1, 0, 'C');
                    $pdf->Cell(35, 6, $linha['cond_pagto'], 1, 0, 'C');
                    $pdf->Cell(34, 6, $linha['fk_cliente_cod'], 1, 0, 'C');
                    $pdf->Cell(36, 6, $linha['fk_vendedor_cod'], 1, 0, 'C');
                    $pdf->Cell(34, 6, $linha['cod'], 1, 0, 'C');
                    $pdf->Cell(48, 6, $linha['nome'], 1, 0, 'C');
                    $pdf->Ln();

                    $i++;
                }
            }
            $pdf->Output($nome_arq_relatorio, 'F');
        } 
    }

    gerar_relatorios($tabelas);
?>