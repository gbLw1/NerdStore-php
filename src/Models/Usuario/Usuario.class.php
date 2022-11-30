<?php
    class Usuario{

        public function __construct(
            private int $codigo = 0,
            private string $nome = "",
            private string $email = "",
            private string $senha = "",
            private $tipo_usuario,
            private bool $ativo = true,
            private $endereco
        ){}
            
        //Métodos Get

        public function getCodigo(){ return $this->codigo; }

        public function getNome(){ return $this->nome; }

        public function getEmail(){ return $this->email; }

        public function getSenha(){ return $this->senha; }

        public function getTipoUsuario(){ return $this->tipo_usuario; }

        public function getAtivo(){ return $this->ativo; }

        public function getEndereco(){ return $this->endereco; }

        //Métodos Set

        public function setCodigo(int $codigo){ $this->codigo = $codigo;}

        public function setNome(string $nome){ $this->nome = $nome;}

        public function setEmail(string $email){ $this->email = $email;}

        public function setSenha(string $senha){ $this->senha = $senha;}

        public function setTipoUsuario($tipo_usuario){ $this->tipo_usuario = $tipo_usuario;}

        public function setAtivo(bool $ativo){ $this->ativo = $ativo;}

        public function setEndereco($endereco){ $this->endereco = $endereco;}
    }

?>