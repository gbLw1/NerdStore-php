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
        $sql = "SELECT c.codigo as codigo,
                    p.descricao as descricao,
                    p.valor as valor,
                    c.quantidade as quantidade,
                    p.codigo as produtoCodigo,
                    p.foto as produtoFoto
                    FROM carrinhos c INNER JOIN produtos p ON (c.produto = p.codigo)
                    where c.usuario = ?";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $userId);
        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function ObterValorTotalCarrinho($userId)
    {
        $sql = "SELECT SUM(p.valor * c.quantidade) AS total FROM produtos p INNER JOIN carrinhos c ON (p.codigo = c.produto)
                WHERE c.usuario = ? GROUP BY c.usuario";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $userId);
        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function ObterQuantidadeItensCarrinho($userId)
    {
        $sql = "SELECT COUNT(codigo) as total FROM carrinhos WHERE usuario = ?";
        
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
        $stm->bindValue(2, $produto->codigo);
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
        $stm->bindValue(3, $produto);

        $stm->execute();

        $this->db = null;
    }

    public function AdicionarQuantidadeItemExistente($userId, $produto, $qtde)
    {
        $sql = "UPDATE carrinhos SET quantidade = quantidade + ?
                WHERE usuario = ? AND produto = ?";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $qtde);
        $stm->bindValue(2, $userId);
        $stm->bindValue(3, $produto);

        $stm->execute();

        $this->db = null;
    }

    public function DeletarCarrinhoItem($userId, $produto)
    {
        $sql = "DELETE FROM carrinhos WHERE usuario = ? AND produto = ?";
        
        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $userId);
        $stm->bindValue(2, $produto);

        $stm->execute();

        $this->db = null;
    }

    public function DeletarCarrinho($userId)
    {
        $sql = "DELETE FROM carrinhos WHERE usuario = ?";
        
        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $userId);

        $stm->execute();

        $this->db = null;
    }
}