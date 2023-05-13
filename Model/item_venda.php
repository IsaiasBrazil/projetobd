<?php
class ItemVenda
{
    private int $cod_venda;
    private String $produto;
    private int $quant_vendida;


    public function __construct( $produto, $quant_vendida)
    {
        $this->produto = $produto;
        $this->quant_vendida = $quant_vendida;
    }

    public function getProduto():String
    {
        return $this->produto;
    }

	/**
	 * @param  $cod_venda 
	 * @return self
	 */
	public function setCod_venda(int $cod_venda): self {
		$this->cod_venda = $cod_venda;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getQtd(): int {
		return $this->quant_vendida;
	}
}

?>