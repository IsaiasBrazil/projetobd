<?php
    require('fpdf185/fpdf.php');
    $tabelas = array('produto');

    function gerar_relatorios($lista_tabelas) {
        $nome_arq_relatorio;
        require('conexao.php');

        foreach ($lista_tabelas as $tabela) {
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
        } 

        $pdf->Output($nome_arq_relatorio, 'F');
    }

    gerar_relatorios($tabelas);
?>