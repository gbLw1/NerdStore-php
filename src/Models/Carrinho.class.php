<?php

class Carrinho{
    public function __construct(
        private $produto,
        private int $quantidade = 0
    ){}

    //Métodos Get
    
    public function getProduto(){ return $this->produto; }

    public function getQuantidade(){ return $this->quantidade; }

    //Métodos Set

    public function setProduto($produto){ $this->produto = $produto;}

    public function setQuantidade(int $quantidade){ $this->quantidade = $quantidade;}
}

?>