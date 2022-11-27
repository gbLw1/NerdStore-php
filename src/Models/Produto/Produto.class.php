<?php

class Produto{
    public function __construct(
        private int $codigo = 0,
        private string $descricao = "",
        private float $valor = 0,
        private int $estoque = 0,
        private bool $ativo = true,
        private string $observacao = ""
    ){}

    // Métodos Get
    
    public function getCodigo(){ return $this->codigo; }

    public function getDescricao(){ return $this->descricao; }

    public function getValor(){ return $this->valor; }

    public function getEstoque(){ return $this->estoque; }

    public function getAtivo(){ return $this->ativo; }

    public function getObservacao(){ return $this->observacao; }

    //Métodos Set

    public function setCodigo(int $codigo){ $this->codigo = $codigo;}

    public function setDescricao(string $descricao){ $this->descricao = $descricao;}

    public function setValor(float $valor){ $this->valor = $valor;}

    public function setEstoque(int $estoque){ $this->estoque = $estoque;}

    public function setAtivo(bool $ativo){ $this->ativo = $ativo;}

    public function setObservacao(string $observacao){ $this->observacao = $observacao;}
}

?>