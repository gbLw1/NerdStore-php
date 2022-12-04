<!-- PedidoController:
 - ObterPedidos -> Lista de pedidos
 - ObterPedidoDetalhe -> tela de detalhes do pedido (informações completa do pedido) -->

<?php

require_once realpath(dirname(__FILE__)) . "/../Models/Conexao.php";
require_once realpath(dirname(__FILE__)) . "/../Models/Pedido.class.php";
require_once realpath(dirname(__FILE__)) . "/../Models/PedidoDAO.class.php";

class PedidoController extends MainController
{
    public function ObterPedidos($codigo)
    {
        $pedidoDAO = new PedidoDAO();
        $pedidos = $pedidoDAO->ObterPedidosPorUsuarioID($codigo);

        return $pedidos;
    }

    public function ObterPedidoPorCodigo($codigo)
    {
        $pedidoDAO = new PedidoDAO();
        $pedidos = $pedidoDAO->ObterPedidoPorId($codigo);

        return $pedidos;
    }

    public function ObterPedidoDetalhe($id)
    {
        $pedidoDAO = new PedidoDAO();
        $pedido = $pedidoDAO->ObterPedidoDetalhePorPedidoID($id);

        return $pedido;
    }

    public function ObterUltimoPedido($id)
    {
        $pedidoDAO = new PedidoDAO();
        $pedido = $pedidoDAO->ObterUltimoPedidoPorUsuarioID($id);

        return $pedido;
    }

    public function AdicionarPedidoDetalhe($pedidoId, $produto, $quantidade)
    {
        $pedidoitem = new PedidoItem($produto->codigo, $produto->foto, $produto->descricao, $produto->valor, $quantidade);

        $pedidoDAO = new PedidoDAO();
        $pedidoDAO->AdicionarPedidoDetalhe($pedidoId, $pedidoitem);
    }

    public function AdicionarPedido($usuarioId, $valor_total)
    {
        $pedidoDAO = new PedidoDAO();
        $pedidoDAO->AdicionarPedido($usuarioId, $valor_total);
    }
}