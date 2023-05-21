<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCtype html>
<html>

<head>
    <title>LOJA FATEC ADS NOITE</title>
    <style>
        .sep {
            /* background-color: lightblue; */
            visibility: visible;
            position: relative;
            z-index: 1;
            float: left;
            width: 5px;
            top: -3px;
            margin-right: 10px;
            height: 20px;
        }

        .left-box {
            position: relative;
            background-color: white;
            width: 100px;
            height: fit-content;
            margin-top: -1px;
            padding-top: 8px;
            float: left;
            display: none;
            z-index: 1;
            margin-right: 10px;
            font-size: 20px;
        }

        .menu-dropdown {
            position: absolute;
            top: 20px;
            left: 10px;
            display: none;
            z-index: 2;
            background-color: lightblue;
            padding: 10px;
           // box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .menu-opts {
            background-color: lightblue;
            visibility: visible;
            position: relative;
            float: left;
            top:-20px;
            width: 100px;
            margin-right: 10px;
            height: 20px;
        }

        .menu-opts:hover {
            background-color: aquamarine;
        }

        .menu-opts:hover .menu-dropdown {
            display: block;
            z-index: 2;
        }

        .report {
            background-color: lightblue;
            visibility: visible;
            position: absolute;
            overflow: hidden;
            width: 200px;
            top: 13px;
            right: 20px;
            height: 30px;
            text-align: right;
            font-size: 20px;
        }

        .box {
            width: 100%;
            height: 20px;
            background-color: lightblue;
            margin-bottom: 0px;
            clear: left;
            font-size: 20px;
        }

        #titulo {
            background-color: lightblue;
            width: 100%;
            text-align: center;
            height: 60px;
            font-weight: bold;
            font-size: 20px;
        }

        a:hover {
            background-color: aquamarine;
        }

        #divtela {
            background-color: yellow;
            position: absolute;
            top: 70px;
            width: 1400px;
            height: 600px;

        }
    </style>

</head>

<body style="background-color: yellow;" id="corpo">

    <div id='titulo'>
        ATIVIDADE LOJA
    </div>

    <div id="divmenu" class="menu-opts">
        <a href="#">Clientes</a>
        <div class="menu-dropdown" id="menuClientes">
            <a target="tela" href="cad_alt/cad_alt_cliente.php">Cadastrar</a>
            <br>
            <a target="tela" href="lista/lista_cliente.php">Alterar </a>
            <br>
            <a target="tela" href="lista/lista_cliente.php">Excluir </a>
            <br>
            <a target="tela" href="lista/lista_cliente.php">Consultar</a>
        </div>

    </div>
    <div class="sep">
    </div>

    <div class="menu-opts">
        <a href="#">Vendedores</a>
        <div class="menu-dropdown">
            <a target="tela" href="cad_alt/cad_alt_vendedor.php">Cadastrar</a>
            <br>
            <a target="tela" href="lista/lista_vendedor.php">Alterar </a>
            <br>
            <a target="tela" href="lista/lista_vendedor.php">Excluir </a>
            <br>
            <a target="tela" href="lista/lista_vendedor.php">Consultar</a>
        </div>

    </div>
    <div class="sep">
    </div>

    <div class="menu-opts">
        <a href="#">Categorias</a>
        <div class="menu-dropdown">
            <a target="tela" href="cad_alt/cad_alt_categoria.php">Cadastrar</a>
            <br>
            <a target="tela" href="lista/lista_categoria.php">Alterar </a>
            <br>
            <a target="tela" href="lista/lista_categoria.php">Excluir </a>
            <br>
            <a target="tela" href="lista/lista_categoria.php">Consultar</a>
        </div>

    </div>
    <div class="sep">
    </div>

    <div class="menu-opts">
        <a href="#">Produtos</a>
        <div id="menuProdutos" class="menu-dropdown">
            <a target="tela" href="cad_alt/cad_alt_produto.php">Cadastrar</a>
            <br>
            <a target="tela" href="lista/lista_produto.php">Alterar </a>
            <br>
            <a target="tela" href="lista/lista_produto.php">Excluir </a>
            <br>
            <a target="tela" href="lista/lista_produto.php">Consultar</a>
        </div>

    </div>
    <div class="sep">
    </div>
    <div class="menu-opts">

        <a href="#">Vendas</a>
        <div class="menu-dropdown" style="width:90px">
            <a href="cad_alt/cad_alt_venda.php" target="tela">Vender</a>
            <br>
            <a href="lista/lista_venda.php" target="tela">Listar vendas</a>
        </div>

    </div>
    <div class="report">
        <a target="tela" href="tela_relatorio.php">Gerar Relatórios: <img src="relatorio_ifm.png" alt="Relatórios"
                style="height:30px" title="Gerar Relatórios"></a>
    </div>
    </div>


    <div id="divtela">
        <iframe name="tela" id="tela" style="border:0px;width:1300px;height:550px;">
            Conteudo
        </iframe>
    </div>
    <script>
        function divTela() {
            divtela.style.zIndex = 1;
        }

        function setDivTela() {
            divTela();
        }

        menuClientes.addEventListener("click", divTela);
        menuVendedores.addEventListener("click", divTela);
        menuCategorias.addEventListener("click", divTela);
        menuProdutos.addEventListener("click", divTela);
        divtela.addEventListener("mouseleave", function () {
            divtela.style.zIndex = -1;
        });
    </script>

</body>

</html>