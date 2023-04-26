<?php

    class Categoria {
        private $cod;
        private $descricao;

        public function __construct($cod, $descricao) {
            $this->cod = $cod;
            $this->descricao = $descricao;
        }
    }

?>