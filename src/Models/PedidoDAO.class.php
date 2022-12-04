<?php

class PedidoDAO extends Conexao
{
    public function __construct()
    {
        parent:: __construct();
    }

     
    public function ObterPedidosPorUsuarioID($UsuarioID)
    {
        $sql = "SELECT codigo, usuario, valor_total FROM pedidos WHERE usuario = ?";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $UsuarioID);
        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function ObterUltimoPedidoPorUsuarioID($UsuarioID)
    {
        $sql = "SELECT codigo, usuario, valor_total FROM pedidos WHERE usuario = ? ORDER BY codigo DESC LIMIT 1";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $UsuarioID);
        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function AdicionarPedidoDetalhe($PedidoId, $PedidoItem)
    {
        $sql = "INSERT INTO pedido_detalhe (pedido, produto, descricao, valor, quantidade) VALUES (?,?,?,?,?)";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $PedidoId);
        $stm->bindValue(2, $PedidoItem->getProdutoCodigo());
        $stm->bindValue(3, $PedidoItem->getDescricao());
        $stm->bindValue(4, $PedidoItem->getValor());
        $stm->bindValue(5, $PedidoItem->getQuantidade());

        $stm->execute();
        $this->db = null;
    }

    public function AdicionarPedido($UsuarioId, $ValorTotal)
    {
        $sql = "INSERT INTO pedidos (usuario, valor_total) VALUES (?,?)";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $UsuarioId);
        $stm->bindValue(2, $ValorTotal);

        $stm->execute();
        $this->db = null;
    }

    public function ObterPedidoPorId($codigo)
    {
        $sql = "SELECT codigo, usuario, valor_total FROM pedidos WHERE codigo = ?";

        $stm = $this->db->prepare($sql);

        $stm->bindValue(1, $codigo);
        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    

    public function ObterPedidoDetalhePorPedidoID($PedidoID)
    {
        $sql = "SELECT p.codigo, p.foto, p.descricao, pe.valor, pe.quantidade 
         FROM produtos p INNER JOIN pedido_detalhe pe ON (pe.produto = p.codigo) WHERE pe.pedido = ?";
        
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $PedidoID);
        $stm->execute();

        $this->db = null;

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

}