<?php

require_once "../../Data/Conexao.php";

class EnderecoDAO extends Conexao
{
    public function __construct()
    {
        parent:: __construct();
    }

     
    public function ObterEnderecoPorUsuarioId($usuarioID)
    {
        $sql = "SELECT codigo, logradouro, numero, bairro, cidade, cep,
        uf, complemento FROM enderecos INNER JOIN usuarios ON (enderecos.codigo = usuarios.endereco)
        WHERE usuarios.codigo = ?";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $usuarioID);

        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function ObterEnderecoPorLogradouroNumeroBairro($logradouro, $numero, $bairro)
    {
        $sql = "SELECT codigo, logradouro, numero, bairro, cidade, cep,
        uf, complemento FROM enderecos WHERE logradouro = ? AND numero = ? AND bairro = ?";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $logradouro);
        $stm->bindValue(2, $numero);
        $stm->bindValue(3, $bairro);

        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function AdicionarEndereco(Endereco $endereco)
    {
        $sql = "INSERT INTO enderecos (logradouro, numero, bairro, cidade, cep,
        uf, complemento) VALUES (?,?,?,?,?,?,?)";
        
        $stm = $this->db->prepare($sql); 

        $stm->bindValue(1, $endereco->getLogradouro());
        $stm->bindValue(2, $endereco->getNumero());
        $stm->bindValue(3, $endereco->getBairro());
        $stm->bindValue(4, $endereco->getCidade());
        $stm->bindValue(5, $endereco->getCep());
        $stm->bindValue(6, $endereco->getUf());
        $stm->bindValue(7, $endereco->getComplemento());

        
        $stm->execute();
        
        $this->db = null;
    }

    public function AtualizarEndereco(Endereco $endereco)
    {
        $sql = "UPDATE enderecos SET logradouro = ?, numero = ?, bairro = ?, cidade = ?, cep = ?,
        uf = ?, complemento = ? WHERE codigo = ?";
        
        $stm = $this->db->prepare($sql); 

        $stm->bindValue(1, $endereco->getLogradouro());
        $stm->bindValue(2, $endereco->getNumero());
        $stm->bindValue(3, $endereco->getBairro());
        $stm->bindValue(4, $endereco->getCidade());
        $stm->bindValue(5, $endereco->getCep());
        $stm->bindValue(6, $endereco->getUf());
        $stm->bindValue(7, $endereco->getComplemento());
        $stm->bindValue(8, $endereco->getCodigo());
        
        $stm->execute();
        
        $this->db = null;
    }

}