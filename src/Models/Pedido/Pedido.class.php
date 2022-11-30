<?php

class Pedido{
    public function __construct(
        private int $codigo = 0,
        private float $valor_total = 0,
        private array $pedido_items = array()
    ){}

    //Métodos Get

    public function getCodigo(){ return $this->codigo; }

    public function getValorTotal(){ return $this->valor_total; }

    public function getPedidoItems(){ return $this->pedido_items; }

    //Métodos Set

    public function setCodigo(int $codigo){ $this->codigo = $codigo;}

    public function setValorTotal(float $valor_total){ $this->valor_total = $valor_total;}

    public function setPedidoItems(array $pedido_items){ $this->pedido_items[] = $pedido_items;}
}

class PedidoItem{
    public function __construct(
        private int $produto_codigo = 0,
        private string $produto_foto = "",
        private string $descricao = "",
        private float $valor = 0,
        private int $quantidade = 0
    ){}

    //Métodos Get

    public function getProdutoCodigo(){ return $this->produto_codigo; }

    public function getProdutoFoto(){ return $this->produto_foto; }

    public function getDescricao(){ return $this->descricao; }

    public function getValor(){ return $this->valor; }

    public function getQuantidade(){ return $this->quantidade; }

    //Métodos Set

    public function setProdutoCodigo(int $produto_codigo){ $this->produto_codigo = $produto_codigo;}

    public function setProdutoFoto(int $produto_foto){ $this->produto_foto = $produto_foto;}

    public function setDescricao(string $descricao){ $this->descricao = $descricao;}

    public function setValor(float $valor){ $this->valor = $valor;}

    public function setQuantidade(int $quantidade){ $this->quantidade = $quantidade;}
}

?>