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
        $carrinhoItens = $carrinhoDAO->ObterCarrinhoItens($userId);

        if(is_array($carrinhoItens) && count($carrinhoItens) > 0)
        {
            foreach($carrinhoItens as $item)
            {
                //Produto a ser adicionado já está no carrinho
                if($item->produtoCodigo == $produto->codigo){
                    $this->AdicionarQuantidadeItemExistente($userId, $produto->codigo, $quantidade);
                    return;
                }      
                
            }
        }

        $carrinhoDAO = new CarrinhoDAO();
        $carrinhoDAO->AddCarrinhoItem($userId, $produto, $quantidade);
        header("location:carrinho.php");
            
    }

    public function AtualizarItemQuantidade($id, $idProduto, $quantidade)
    {
        $carrinhoDAO = new CarrinhoDAO();
        $produtoDAO = new ProdutoDAO();
        $produto = $produtoDAO->ObterProdutoPorId($idProduto);

        if($quantidade > $produto[0]->estoque){
            echo "<script>alert('O produto {$produto[0]->descricao} possui somente {$produto[0]->estoque} em estoque')</script>";
        }

        else{

            $carrinhoDAO->AtualizarCarrinhoItemQuantidade($id, $idProduto, $quantidade);

            header("location:carrinho.php");
        }
    }

    public function AdicionarQuantidadeItemExistente($id, $idProduto, $quantidade)
    {
        $carrinhoDAO = new CarrinhoDAO();
        $carrinhoDAO->AdicionarQuantidadeItemExistente($id, $idProduto, $quantidade);

        header("location:carrinho.php");
    }

    public function RemoverItem($id, $idProduto)
    {
        $carrinhoDAO = new CarrinhoDAO();
        $carrinhoDAO->DeletarCarrinhoItem($id, $idProduto);
        header("location:carrinho.php");
    }

    public function ExcluirCarrinho($usuarioId)
    {
        $carrinhoDAO = new CarrinhoDAO();
        $carrinhoDAO->DeletarCarrinho($usuarioId);
        header("location:pedidos.php");
    }
}