<?php

require_once "../../Data/Conexao.php";

class ProdutoDAO extends Conexao
{
    public function __construct()
    {
        parent:: __construct();
    }

     
    public function ObterProdutoPorId($ProdutoID)
    {
        $sql = "SELECT codigo, descricao, valor, estoque, ativo, observacao,
        foto FROM produtos WHERE codigo = ?;";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $ProdutoID);
        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function ObterProdutosAtivos()
    {
        $sql = "SELECT codigo, descricao, valor, estoque, ativo, observacao,
        foto FROM produtos WHERE ativo = 1";
        
        $stm = $this->db->prepare($sql);

        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function ObterTodosProdutos()
    {
        $sql = "SELECT codigo, descricao, valor, estoque, ativo, observacao,
        foto FROM produtos";
        
        $stm = $this->db->prepare($sql);

        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function AdicionarProduto(Produto $produto)
    {
        $sql = "INSERT INTO produtos (descricao, valor, estoque, ativo, observacao,
        foto) VALUES (?,?,?,?,?,?)";
        
        $stm = $this->db->prepare($sql); 

        $stm->bindValue(1, $produto->getDescricao());
        $stm->bindValue(2, $produto->getValor());
        $stm->bindValue(3, $produto->getEstoque());
        $stm->bindValue(4, 1);
        $stm->bindValue(5, $produto->getObservacao());
        $stm->bindValue(6, $produto->getFoto());
        
        $stm->execute();
        
        $this->db = null;
    }

    public function AtualizarProduto(Produto $produto)
    {
        $sql = "UPDATE produtos SET descricao = ?, valor = ?, estoque = ?, ativo = ?, observacao = ?,
        foto = ? WHERE codigo = ?";
        
        $stm = $this->db->prepare($sql); 

        $stm->bindValue(1, $produto->getDescricao());
        $stm->bindValue(2, $produto->getValor());
        $stm->bindValue(3, $produto->getEstoque());
        $stm->bindValue(4, $produto->getAtivo());
        $stm->bindValue(5, $produto->getObservacao());
        $stm->bindValue(6, $produto->getFoto());
        $stm->bindValue(7, $produto->getCodigo());
        
        $stm->execute();
        
        $this->db = null;
    }

    public function DeletarProduto($ProdutoID)
    {
        $sql = "UPDATE produto SET ativo = 0 WHERE codigo = ?";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $ProdutoID);

        $stm->execute();

        $this->db = null;
    }

}