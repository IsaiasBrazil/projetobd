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
                $query = 'SELECT * FROM produto';
                $resu = mysqli_query($con, $query);
                $qt_registros = mysqli_num_rows($resu);

                // Criando os nomes das colunas
                $pdf->Cell(15, 6, 'cod', 1, 0, 'C');
                $pdf->Cell(110, 6, 'nome', 1, 0, 'C');
                $pdf->Cell(40, 6, 'preco', 1, 0, 'C');
                $pdf->Cell(35, 6, 'qtd_estoque', 1, 0, 'C');
                $pdf->Cell(42, 6, 'unidade_medida', 1, 0, 'C');
                $pdf->Cell(42, 6, 'fk_categoria_id', 1, 0, 'C');
                $pdf->Ln();

                $i = 0;
                while ($linha = mysqli_fetch_assoc($resu)) {
                    $pdf->Cell(15, 6, $linha['cod'], 1, 0, 'C');
                    $pdf->Cell(110, 6, $linha['nome'], 1, 0, 'C');
                    $pdf->Cell(40, 6, $linha['preco'], 1, 0, 'C');
                    $pdf->Cell(35, 6, $linha['qtd_estoque'], 1, 0, 'C');
                    $pdf->Cell(42, 6, $linha['unidade_medida'], 1, 0, 'C');
                    $pdf->Cell(42, 6, $linha['fk_categoria_id'], 1, 0, 'C');
                    $pdf->Ln();

                    $i++;
                }
            }
        } 

        $pdf->Output($nome_arq_relatorio, 'F');
    }

    gerar_relatorios($tabelas);
?>