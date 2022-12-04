<?php

class CarrinhoDAO extends Conexao
{
    public function __construct()
    {
        parent:: __construct();
    }

    /*
    - obter carrinho (com todos os itens)
    - obter quantidade dos itens do carrinho (exibição no header)
    - add item
    - atualizar item quantidade
    - deletar item
    */

    // $userId é o Id do usuário vindo da session storage
    public function ObterCarrinhoItens($userId)
    {
        //$sql = "SELECT codigo, usuario, produto, quantidade FROM carrinhos WHERE usuario = ?";
        $sql = "SELECT c.codigo
                        , p.foto
                        , p.descricao
                        , p.valor
                        , c.quantidade
                FROM carrinhos c
                INNER JOIN produtos p ON (c.produto = p.codigo)
                WHERE c.usuario = ?";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $userId);
        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function ObterQuantidadeItensCarrinho($userId)
    {
        $sql = "SELECT COUNT(codigo) FROM carrinhos WHERE usuario = ?";
        
        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $userId);
        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    // Id do usuário da session, objeto produto, quantidade desejada
    public function AddCarrinhoItem($userId, $produto, $qtde)
    {
        $sql = "INSERT INTO carrinhos (usuario, produto, quantidade) VALUES(?,?,?)";
        
        $stm = $this->db->prepare($sql); 

        $stm->bindValue(1, $userId);
        $stm->bindValue(2, $produto->getCodigo());
        $stm->bindValue(3, $qtde);
        
        $stm->execute();
        
        $this->db = null;
    }

    public function AtualizarCarrinhoItemQuantidade($userId, $produto, $qtde)
    {
        $sql = "UPDATE carrinhos SET quantidade = ?
                WHERE usuario = ? AND produto = ?";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $qtde);
        $stm->bindValue(2, $userId);
        $stm->bindValue(3, $produto->getCodigo());

        $stm->execute();

        $this->db = null;
    }

    public function DeletarCarrinhoItem($userId, $produto)
    {
        $sql = "DELETE FROM carrinhos WHERE usuario = ? AND produto = ?";
        
        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $userId);
        $stm->bindValue(2, $produto->getCodigo());

        $stm->execute();

        $this->db = null;
    }
}