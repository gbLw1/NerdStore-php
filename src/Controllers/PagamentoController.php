<!-- PagamentoController: fluxo completo de pagamento, mas deve ser apenas um mock -->

<?php

require_once realpath(dirname(__FILE__)) . "/../Models/Conexao.php";
require_once realpath(dirname(__FILE__)) . "/../Models/Pagamento.class.php";
require_once realpath(dirname(__FILE__)) . "/../Models/PagamentoDAO.class.php";

class PagamentoController extends MainController
{
    public function ObterPagamentos()
    {
        $pagamentoDAO = new PagamentoDAO();
        $pagamentos = $pagamentoDAO->ObterPagamentos();

        return $pagamentos;
    }

    public function ObterPagamentoDetalhe($id)
    {
        $pagamentoDAO = new PagamentoDAO();
        $pagamento = $pagamentoDAO->ObterPagamento($id);

        return $pagamento;
    }

    public function AddPagamento($pagamento)
    {
        $pagamentoDAO = new PagamentoDAO();
        $pagamentoDAO->AddPagamento($pagamento);
    }

    public function AtualizarPagamento($pagamento)
    {
        $pagamentoDAO = new PagamentoDAO();
        $pagamentoDAO->AtualizarPagamento($pagamento);
    }

    public function RemoverPagamento($pagamento)
    {
        $pagamentoDAO = new PagamentoDAO();
        $pagamentoDAO->RemoverPagamento($pagamento);
    }
}

?>