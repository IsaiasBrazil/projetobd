<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCtype html>
<html>

<head>
    <title>LOJA FATEC ADS NOITE</title>


</head>

<body style="background-color: yellow;" id="corpo">

    <div id='titulo'
        style="background-color: lightblue;width: 100%;text-align: center;height:20px;font-weight: bold;font-size: 20px;">
        ATIVIDADE LOJA
    </div>
    <div id="divmenu" style="background-color: lightblue;">
        <a onmouseover="document.getElementById('menuClientes').style.visibility='visible';divtela.style.zIndex=-1;divmenu.style.zIndex = 1;"
            onmouseout="document.getElementById('menuClientes').style.visibility='hidden';" href="#">Clientes</a>&Tab;
        <a onmouseover="document.getElementById('menuVendedores').style.visibility='visible';divtela.style.zIndex=-1;divmenu.style.zIndex = 1;"
            onmouseout="document.getElementById('menuVendedores').style.visibility='hidden';"
            href="#">Vendedores</a>&Tab;

        <a onmouseover="document.getElementById('menuCategorias').style.visibility='visible';divtela.style.zIndex=-1;divmenu.style.zIndex = 1;"
            onmouseout="document.getElementById('menuCategorias').style.visibility='hidden';"
            href="#">Categorias</a>&Tab;
        <a onmouseover="document.getElementById('menuProdutos').style.visibility='visible';divtela.style.zIndex=-1;divmenu.style.zIndex = 1;"
            onmouseout="document.getElementById('menuProdutos').style.visibility='hidden';" href="#">Produtos</a>
        <a href="cad_alt_venda.php" target="tela" onclick="console.log('clicou')">Vender</a>
    </div>

    <div onmouseout="this.style.visibility='hidden';" onmouseover="this.style.visibility='visible';" id="menuClientes"
        style="visibility: hidden; z-index: 1;background-color: white;width :75px;margin:initial">
        <a target="tela" style="background-color:white" href="cad_alt_cliente.php">Cadastrar</a>
        <br>
        <a target="tela" style="background-color:white" href="lista_cliente.php">Alterar </a>
        <br>
        <a target="tela" style="background-color:white" href="lista_cliente.php">Excluir </a>
        <br>
        <a target="tela" style="background-color:white" href="lista_cliente.php">Consultar</a>
    </div>


    <div onmouseout="this.style.visibility='hidden';" onmouseover="this.style.visibility='visible';" id="menuVendedores"
        style="visibility: hidden; z-index: 1;background-color: white;width :75px; margin-top:-74px;margin-left: 57px; ">
        <a target="tela" style="background-color:white" href="cad_alt_vendedor.php">Cadastrar</a>
        <br>
        <a target="tela" style="background-color:white" href="lista_vendedor.php">Alterar </a>
        <br>
        <a target="tela" style="background-color:white" href="lista_vendedor.php">Excluir </a>
        <br>
        <a target="tela" style="background-color:white" href="lista_vendedor.php">Consultar</a>
    </div>

    <div onmouseout="this.style.visibility='hidden';" onmouseover="this.style.visibility='visible';" id="menuCategorias"
        style="visibility: hidden; z-index: 1;background-color: white;width :75px; margin-top:-74px;margin-left: 135px;">
        <a target="tela" style="background-color:white" href="cad_alt_categoria.php">Cadastrar</a>
        <br>
        <a target="tela" style="background-color:white" href="lista_categoria.php">Alterar </a>
        <br>
        <a target="tela" style="background-color:white" href="lista_categoria.php">Excluir </a>
        <br>
        <a target="tela" style="background-color:white" href="lista_categoria.php">Consultar</a>
    </div>

    <div onmouseout="this.style.visibility='hidden';" onmouseover="this.style.visibility='visible';" id="menuProdutos"
        style="visibility: hidden; z-index: 1;background-color: white;width :75px; margin-top:-74px;margin-left: 208px;">
        <a target="tela" style="background-color:white" href="cad_alt_produto.php">Cadastrar</a>
        <br>
        <a target="tela" style="background-color:white" href="lista_produto.php">Alterar </a>
        <br>
        <a target="tela" style="background-color:white" href="lista_produto.php">Excluir </a>
        <br>
        <a target="tela" style="background-color:white" href="lista_produto.php">Consultar</a>
    </div>


    <div id="divtela"
        style="background-color:yellow; position:relative; z-index: -1;margin-top: -75px;width:100%; height:800px;">
        <iframe name="tela" id="tela" scrolling="auto" frameborder="0" width="100%" height="100%" allowfullscreen>
            Conteudo
        </iframe>
    </div>
    <script>
        divtela.addEventListener("mouseout", function () {
            divtela.style.zIndex = -1;
            divmenu.style.zIndex = 1;
        });


        function divTela() {
            divtela.style.zIndex = 1;
        }

        menuClientes.addEventListener("click", divTela);
        menuVendedores.addEventListener("click", divTela);
        menuCategorias.addEventListener("click", divTela);
        menuProdutos.addEventListener("click", divTela);
        document.body.addEventListener("click", divTela);
    </script>

</body>

</html>