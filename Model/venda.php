
<?php
    class Venda {
    private $cod;
    private $cod_cliente;
    private $cod_vendedor;
    private $venda;
    private $data;
    private $prazo_entrega;
    private $cond_pagto;
    private $itens_vendas;

    public function __construct($cod, $cliente, $vendedor, $venda, $data, $prazo_entrega, $cond_pagto, $itens_vendas)
    {
        $this->cod = $cod;
        $this->cod_cliente = $cliente;
        $this->cod_vendedor = $vendedor;
        $this->venda = $venda;
        $this->data = $data;
        $this->prazo_entrega = $prazo_entrega;
        $this->cond_pagto = $cond_pagto;
        $this->itens_vendas = $itens_vendas;
    } 
    }
?>
