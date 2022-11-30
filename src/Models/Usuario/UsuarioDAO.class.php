<?php

require_once "../../Data/Conexao.php";

class UsuarioDAO extends Conexao
{
    public function __construct()
    {
        parent:: __construct();
    }

     
    public function ObterUsuarioPorId($usuarioID)
    {
        $sql = "SELECT codigo, nome, email, senha, tipo_usuario, ativo, endereco
        FROM usuarios WHERE codigo = ?";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $usuarioID);

        $stm->execute();

        $this->db = null;
    }

    
    public function AdicionarUsuario(Usuario $usuario)
    {
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario, ativo, endereco)
        VALUES (?,?,?,?,?,?)";
        
        $stm = $this->db->prepare($sql); 

        $stm->bindValue(1, $usuario->getNome());
        $stm->bindValue(2, $usuario->getEmail());
        $stm->bindValue(3, $usuario->getSenha());
        $stm->bindValue(4, $usuario->getTipoUsuario());
        $stm->bindValue(5, $usuario->getAtivo());
        $stm->bindValue(6, $usuario->getEndereco()->getCodigo());
      
        $stm->execute();
        
        $this->db = null;
    }

    public function AtualizarUsuario(Usuario $usuario)
    {
        $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, tipo_usuario = ?, ativo = ?, endereco = ?
         WHERE codigo = ?";
        
        $stm = $this->db->prepare($sql); 

        $stm->bindValue(1, $usuario->getNome());
        $stm->bindValue(2, $usuario->getEmail());
        $stm->bindValue(3, $usuario->getSenha());
        $stm->bindValue(4, $usuario->getTipoUsuario());
        $stm->bindValue(5, $usuario->getAtivo());
        $stm->bindValue(6, $usuario->getEndereco()->getCodigo());
        $stm->bindValue(7, $usuario->getCodigo());
        
        $stm->execute();
        
        $this->db = null;
    }

    public function ExcluirUsuario($usuarioID)
    {
        $sql = "UPDATE usuarios SET  ativo = 0 WHERE codigo = ?";
        
        $stm = $this->db->prepare($sql); 

        $stm->bindValue(1, $usuarioID);

        $stm->execute();
        
        $this->db = null;
    }

}