<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Relatório</title>
    <style>
        .fonte {
            font-size: 28px;
        }
    </style>
</head>
<body>
    <h1>Relatório</h1>
    <form action="gerar_relatorios.php" method="POST">
        <p>
            <label for="data_inicial" class="fonte">Data inicial:</label>
            <input type="date" name="data_inicial" id="data_inicial" class="fonte" value="<?php echo date('Y-m-d'); ?>">
        </p>

        <p>
            <label for="data_final" class="fonte">Data final:</label>
            <input type="date" name="data_final" id="data_final" class="fonte" value="<?php echo date('Y-m-d'); ?>">
        </p>
        <button type="submit" class="fonte">Gerar relatórios</button>
        <button type="reset" class="fonte">Limpar</button>
    </form>
</body>
</html>