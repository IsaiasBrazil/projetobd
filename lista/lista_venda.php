<!DOCTYPE html>

<html>

<head>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    include_once("../conexao.php");
    require_once("../gridgenerico.php");
    $_SESSION['filtro_data_ini'] = $_POST['filtro_data_ini'] ??$_SESSION['filtro_data_ini']??"";//se post existir seta para o post, senão se o session existir seta para o session, senão vira ""
    $_SESSION['filtro_data_fin'] = $_POST['filtro_data_fin'] ??$_SESSION['filtro_data_fin']??"";
    ?>
    <style>
        label {
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <div>
        <form method="POST">
            <label style="font-weight: bold;">FILTRAR POR DATA:</label>
            <label for="filtro_data_ini">Data inicial:</label>
            <input type="date" name="filtro_data_ini" id="filtro_data_ini" value="<?=$_SESSION['filtro_data_ini'];?>">
            <label for="filtro_data_fin">Data final:</label>
            <input type="date" name="filtro_data_fin" id="filtro_data_fin" value="<?=$_SESSION['filtro_data_fin'];?>">
            <input type="submit" value="Aplicar filtro">
        </form>
    </div>
    <div style="overflow:auto">
        <?php
        $data_ini = $_POST['filtro_data_ini'] ?? "";
        $data_fin = $_POST['filtro_data_fin'] ?? "";
        $_SESSION['filtro_data_ini'] = $data_ini;
        $_SESSION['filtro_data_fin'] = $data_fin;
        if ($data_ini != "" && $data_fin != "") {
            $query = "SELECT v.numero AS 'Codigo(venda)',v.data,v.prazo_entrega AS 'prazo de entrega',v.cond_pagto AS 'forma de pagamento',v.fk_cliente_cod AS 'codigo(cliente)',c.nome AS cliente,v.fk_vendedor_cod AS 'codigo(vendedor)' ,ve.nome AS vendedor FROM venda v INNER JOIN vendedor ve ON ve.cod = v.fk_vendedor_cod INNER JOIN cliente c ON c.cod=v.fk_cliente_cod WHERE DATE(v.data) >= '$data_ini' AND v.data <= '$data_fin'";
        } else
            $query = "SELECT * FROM venda";
        $result = mysqli_query($con, $query);
        grid($result, "VENDAS");
        ?>
    </div>
    <script>
        function atualizaData(e) {
            if (e.value === "") {
                elementoData = new Date;
                elementoData.setHours(new Date().getHours() - 3);
                if(e.name=="filtro_data_ini")
                elementoData.setDate(new Date().getDate() - 30);
                var hoje = elementoData.toISOString().split('T')[0];
                e.value = hoje;
            };
        };
        var data1 = document.getElementById('filtro_data_ini');
        var data2 = document.getElementById('filtro_data_fin');
        atualizaData(data1);
        atualizaData(data2);
    </script>
</body>
</html>