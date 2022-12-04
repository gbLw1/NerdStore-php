<!-- CarrinhoController:
 - ObterCarrinho (por id) -> endpoint para tela de carrinho (com os itens, valor, qtde, etc..)
 - ObterCarrinhoItensQuantidade -> endpoint para consumir no header (apenas a qtde)
 - Add item
 - Atualizar item quantidade
 - Remover item -->

<?php

require_once realpath(dirname(__FILE__)) . "/../Models/Conexao.php";
require_once realpath(dirname(__FILE__)) . "/../Models/Carrinho.class.php";
require_once realpath(dirname(__FILE__)) . "/../Models/CarrinhoDAO.class.php";
require_once realpath(dirname(__FILE__)) . "/../Models/Produto.class.php";
require_once realpath(dirname(__FILE__)) . "/../Models/ProdutoDAO.class.php";

class CarrinhoController extends MainController
{
    public function ObterCarrinhoItens($userId)
    {
        $carrinhoDAO = new CarrinhoDAO();
        $carrinho = $carrinhoDAO->ObterCarrinhoItens($userId);

        return $carrinho;
    }

    public function ObterCarrinhoItensQuantidade($userId)
    {
        $carrinhoDAO = new CarrinhoDAO();
        $carrinho = $carrinhoDAO->ObterQuantidadeItensCarrinho($userId);

        return $carrinho[0]->total;
    }

    public function ObterValorTotalCarrinho($userId)
    {
        $carrinhoDAO = new CarrinhoDAO();
        $carrinho = $carrinhoDAO->ObterValorTotalCarrinho($userId);

        if(count($carrinho) <= 0)
            return 0.0;

        return $carrinho[0]->total;
    }

    public function AddItem($userId, $produto, $quantidade)
    {
        $carrinhoDAO = new CarrinhoDAO();
        $carrinho = $carrinhoDAO->AddCarrinhoItem($userId, $produto, $quantidade);
    }

    public function AtualizarItemQuantidade($id, $idProduto, $quantidade)
    {
        $carrinhoDAO = new CarrinhoDAO();
        $carrinho = $carrinhoDAO->ObterCarrinho($id);

        $produto = new Produto();
        $produto->setId($idProduto);

        $carrinho->AtualizarItemQuantidade($produto, $quantidade);

        $carrinhoDAO->AtualizarCarrinho($carrinho);
    }

    public function RemoverItem($id, $idProduto)
    {
        $carrinhoDAO = new CarrinhoDAO();
        $carrinho = $carrinhoDAO->ObterCarrinho($id);

        $produto = new Produto();
        $produto->setId($idProduto);

        $carrinho->RemoverItem($produto);

        $carrinhoDAO->AtualizarCarrinho($carrinho);
    }
}