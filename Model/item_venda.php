<?php

    class ItemVenda {
        private $cod_venda;
        private $cod_produto;
        private $quant_vendida;

        public function __construct($cod_venda, $cod_produto, $quant_vendida) {
            $this->cod_venda = $cod_venda;
            $this->cod_produto = $cod_produto;
            $this->quant_vendida = $quant_vendida;
        }
    }

?>