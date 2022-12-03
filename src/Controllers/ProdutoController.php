<?php

require_once realpath(dirname(__FILE__)) . "/../Models/Conexao.php";
require_once realpath(dirname(__FILE__)) . "/../Models/Produto.class.php";
require_once realpath(dirname(__FILE__)) . "/../Models/ProdutoDAO.class.php";

class ProdutoController extends MainController
{
    public function CadastrarProduto(Produto $produto)
    {
        $erros = $this->ValidarArgsProduto($produto);

        if(count($erros) > 0)
        {
            $mensagem = "";

            foreach($erros as $erro)
            {
                $mensagem .= $erro . "\\n";
            }

            echo "<script>alert('$mensagem')</script>";
        }
        else
        {
            $produtoDAO = new ProdutoDAO();

            $produtoDAO->AdicionarProduto($produto);

            header("location:../index.php");
        }
    }

    public function ValidarArgsProduto(Produto $produto)
    {
        $erros = array();

        if(trim($produto->getDescricao()) == "")
        {
            $erros[] = "Descrição não pode estar vazio.";
        }

        if(trim($produto->getValor()) == "")
        {
            $erros[] = "Valor não pode estar vazio.";
        }

        if(trim($produto->getEstoque()) == "")
        {
            $erros[] = "Estoque não pode estar vazio.";
        }

        if(trim($produto->getFoto()) == "")
        {
            $erros[] = "Foto não pode estar vazia.";
        }

        return $erros;
    }
}

?>