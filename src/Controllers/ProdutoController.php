<?php

require_once realpath(dirname(__FILE__)) . "/../Models/Conexao.php";
require_once realpath(dirname(__FILE__)) . "/../Models/Produto.class.php";
require_once realpath(dirname(__FILE__)) . "/../Models/ProdutoDAO.class.php";

define("CAMINHO_IMG", "../Views/produtos_imagens/");

class ProdutoController extends MainController
{
    public function CadastrarProduto(Produto $produto)
    {
        $erros = $this->ValidarArgsProduto($produto);

        if (count($erros) > 0) {
            $mensagem = "";

            foreach ($erros as $erro) {
                $mensagem .= $erro . "\\n";
            }

            echo "<script>alert('$mensagem')</script>";
        } else {
            $produtoDAO = new ProdutoDAO();

            $produtoDAO->AdicionarProduto($produto);

            $this->SalvarImagem($produto->getFotoArquivo());

            header("location:../index.php");
        }
    }

    public function ValidarArgsProduto(Produto $produto)
    {
        $erros = array();

        if (trim($produto->getDescricao()) == "") {
            $erros[] = "Descrição não pode estar vazio.";
        }

        if (trim($produto->getValor()) == "") {
            $erros[] = "Valor não pode estar vazio.";
        }

        if (trim($produto->getEstoque()) == "") {
            $erros[] = "Estoque não pode estar vazio.";
        }

        if (trim($produto->getFoto()) == "") {
            $erros[] = "Foto não pode estar vazia.";
        }

        return $erros;
    }

    public function SalvarImagem($imagem)
    {
        $uploadFile = CAMINHO_IMG . $imagem["name"];
        move_uploaded_file($imagem["tmp_name"], $uploadFile);
    }

    public function ObterListaProdutosAtivos()
    {
        $produtoDAO = new ProdutoDAO();
        return $produtoDAO->ObterProdutosAtivos();
    }

    // ProdutoController: (verificar se usuário é ADM -> método da MainController)
    //  - Alterar
    //  - Excluir
    //  - Detalhes (Get by Id)

    public function AtualizarProduto(Produto $produto)
    {
        $erros = $this->ValidarArgsProduto($produto);

        if (count($erros) > 0) {
            $mensagem = "";

            foreach ($erros as $erro) {
                $mensagem .= $erro . "\\n";
            }

            echo "<script>alert('$mensagem')</script>";
        } else {
            $produtoDAO = new ProdutoDAO();

            $produtoDAO->AtualizarProduto($produto);

            $this->SalvarImagem($produto->getFotoArquivo());

            header("location:../index.php");
        }
    }

    public function ExcluirProduto($codigo)
    {
        $produtoDAO = new ProdutoDAO();
        $produtoDAO->DeletarProduto($codigo);
    }

    public function ObterProdutoPorCodigo($codigo)
    {
        $produtoDAO = new ProdutoDAO();
        return $produtoDAO->ObterProdutoPorId($codigo);
    }
}

?>