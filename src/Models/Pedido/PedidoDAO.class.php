<?php

require_once "../../Data/Conexao.php";

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