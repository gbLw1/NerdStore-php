<?php

    class Endereco{
        public function __construct(
            private int $codigo = 0,
            private string $logradouro = "",
            private string $numero = "",
            private string $bairro = "",
            private string $cidade = "",
            private string $cep = "",
            private string $uf = "",
            private string $complemento = ""
        ){}

        //Métodos GET

        public function getCodigo(){ return $this->codigo; }

        public function getLogradouro(){ return $this->logradouro; }

        public function getNumero(){ return $this->numero; }

        public function getBairro(){ return $this->bairro; }

        public function getCidade(){ return $this->cidade; }

        public function getCep(){ return $this->cep; }

        public function getUf(){ return $this->uf; }

        public function getComplemento(){ return $this->complemento; }

        //Métodos Set

        public function setCodigo(int $codigo){ $this->codigo = $codigo;}

        public function setLogradouro(string $logradouro){ $this->logradouro = $logradouro;}

        public function setNumero(string $numero){ $this->numero = $numero;}

        public function setBairro(string $bairro){ $this->bairro = $bairro;}

        public function setCidade(string $cidade){ $this->cidade = $cidade;}

        public function setCep(string $cep){ $this->cep = $cep;}

        public function setUf(string $uf){ $this->uf = $uf;}

        public function setComplemento(string $complemento){ $this->complemento = $complemento;}
    }

?>