<!-- PedidoController:
 - ObterPedidos -> Lista de pedidos
 - ObterPedidoDetalhe -> tela de detalhes do pedido (informações completa do pedido) -->

<?php

require_once realpath(dirname(__FILE__)) . "/../Models/Conexao.php";
require_once realpath(dirname(__FILE__)) . "/../Models/Pedido.class.php";
require_once realpath(dirname(__FILE__)) . "/../Models/PedidoDAO.class.php";

class PedidoController extends MainController
{
    public function ObterPedidos()
    {
        $pedidoDAO = new PedidoDAO();
        $pedidos = $pedidoDAO->ObterPedidos();

        return $pedidos;
    }

    public function ObterPedidoDetalhe($id)
    {
        $pedidoDAO = new PedidoDAO();
        $pedido = $pedidoDAO->ObterPedido($id);

        return $pedido;
    }
}