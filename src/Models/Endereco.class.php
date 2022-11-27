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

        public function getCodigo()
        {
            return $this->codigo;
        }

        public function getLogradouro()
        {
            return $this->logradouro;
        }

        public function getNumero()
        {
            return $this->numero;
        }

        public function getBairro()
        {
            return $this->bairro;
        }

        public function getCidade()
        {
            return $this->cidade;
        }

        public function getCep()
        {
            return $this->cep;
        }

        public function getUf()
        {
            return $this->uf;
        }

        public function getComplemento()
        {
            return $this->complemento;
        }

        //Métodos Set

        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;
        }

        public function setLogradouro($logradouro)
        {
            $this->logradouro = $logradouro;
        }

        public function setNumero($numero)
        {
            $this->numero = $numero;
        }

        public function setBairro($bairro)
        {
            $this->bairro = $bairro;
        }

        public function setCidade($cidade)
        {
            $this->cidade = $cidade;
        }

        public function setCep()
        {
            return $this->cep;
        }

        public function setUf()
        {
            return $this->uf;
        }

        public function setComplemento()
        {
            return $this->complemento;
        }

    }

?>