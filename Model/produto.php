<?php

    class Produto {
        private $cod;
        private $nome;
        private $preco;
        private $qtd_estoque;
        private $unidade_medida;
        private $categoria;
    
    public function __construct($cod, $nome, $preco, $qtd_estoque, $unidade_medida, $categoria) {
        $this->cod = $cod;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->qtd_estoque = $qtd_estoque;
        $this->unidade_medida = $unidade_medida;
        $this->categoria = $categoria;
    }
}
?>