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
        .left-box {
            background-color: white;
            width: 100px;
            height: fit-content;
            margin-top: -1px;
            float: left;
            visibility: hidden;
            z-index: 1;
            margin-right: 1px;
        }

        .left-box-visible {
            background-color: lightblue;
            visibility: visible;
            position: relative;
            z-index: 1;
            float: left;
            width: 100px;
            margin-right: 1px;
            height: fit-content;
        }

        .box {
            width: 100%;
            height: 20px;
            background-color: lightblue;
            margin-bottom: 0px;
            clear: left;
        }

        #titulo {
            background-color: lightblue;
            width: 100%;
            text-align: center;
            height: 20px;
            font-weight: bold;
            font-size: 20px;
            z-index: 1;
        }
    </style>

</head>

<body style="background-color: yellow;" id="corpo">

    <div id='titulo'>
        ATIVIDADE LOJA
    </div>
    <div id="divmenu" class="box">
        <div class="left-box-visible"
            onmouseover="document.getElementById('menuClientes').style.visibility='visible';divtela.style.zIndex=-1;divmenu.style.zIndex = 1;"
            onmouseleave="document.getElementById('menuClientes').style.visibility='hidden';">
            <a href="#">Clientes</a>
        </div>
        <div class="left-box-visible">

            <a onmouseover="document.getElementById('menuVendedores').style.visibility='visible';divtela.style.zIndex=-1;divmenu.style.zIndex = 1;"
                onmouseleave="document.getElementById('menuVendedores').style.visibility='hidden';"
                href="#">Vendedores</a>&Tab;
        </div>
        <div class="left-box-visible">

            <a onmouseover="document.getElementById('menuCategorias').style.visibility='visible';divtela.style.zIndex=-1;divmenu.style.zIndex = 1;"
                onmouseleave="document.getElementById('menuCategorias').style.visibility='hidden';"
                href="#">Categorias</a>&Tab;
        </div>
        <div class="left-box-visible">
            <a onmouseover="document.getElementById('menuProdutos').style.visibility='visible';divtela.style.zIndex=-1;divmenu.style.zIndex = 1;"
                onmouseleave="document.getElementById('menuProdutos').style.visibility='hidden';"
                href="#">Produtos</a>&Tab;
        </div>
        <div class="left-box-visible">

            <a onmouseover="document.getElementById('menuVendas').style.visibility='visible';divtela.style.zIndex=-1;divmenu.style.zIndex = 1;"
                onmouseleave="document.getElementById('menuVendas').style.visibility='hidden';" href="#">Vendas</a>
        </div>
        <div class="left-box-visible">
            <a target="tela" href="tela_relatorio.php">Relatórios</a>
        </div>
    </div>

    <div class="left-box" onmouseleave="this.style.visibility='hidden';" onmouseover="this.style.visibility='visible';"
        id="menuClientes">
        <a target="tela" style="background-color:white" href="cad_alt/cad_alt_cliente.php">Cadastrar</a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_cliente.php">Alterar </a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_cliente.php">Excluir </a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_cliente.php">Consultar</a>
    </div>


    <div onmouseleave="this.style.visibility='hidden';" onmouseover="this.style.visibility='visible';"
        id="menuVendedores" class="left-box">
        <a target="tela" style="background-color:white" href="cad_alt/cad_alt_vendedor.php">Cadastrar</a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_vendedor.php">Alterar </a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_vendedor.php">Excluir </a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_vendedor.php">Consultar</a>
    </div>

    <div onmouseleave="this.style.visibility='hidden';" onmouseover="this.style.visibility='visible';"
        id="menuCategorias" class="left-box">
        <a target="tela" style="background-color:white" href="cad_alt/cad_alt_categoria.php">Cadastrar</a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_categoria.php">Alterar </a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_categoria.php">Excluir </a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_categoria.php">Consultar</a>
    </div>

    <div onmouseleave="this.style.visibility='hidden';" onmouseover="this.style.visibility='visible';" id="menuProdutos"
        class="left-box">
        <a target="tela" style="background-color:white" href="cad_alt/cad_alt_produto.php">Cadastrar</a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_produto.php">Alterar </a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_produto.php">Excluir </a>
        <br>
        <a target="tela" style="background-color:white" href="lista/lista_produto.php">Consultar</a>
    </div>
    <div onmouseleave="this.style.visibility='hidden';" onmouseover="this.style.visibility='visible';" id="menuVendas"
        class="left-box">
        <a href="cad_alt/cad_alt_venda.php" target="tela">Vender</a>
        <br>
        <a href="lista/lista_venda.php" target="tela">Listar vendas</a>
    </div>

    <div id="divtela"
        style="background-color:yellow;position:absolute; z-index: -1;top:50px;width:1400px;height:600px;">
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