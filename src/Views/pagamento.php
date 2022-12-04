<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>NerdStore - Pagamento</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <?php require_once "../header.php" ?>

    <?php 
        if(isset($_POST["pagamento"]))
        {
            require "../Controllers/MainController.php";
            require "../Controllers/CarrinhoController.php";
            require "../Controllers/PedidoController.php";

            $carrinhoController = new CarrinhoController();
            $pedidoController = new PedidoController();
            $carrinhoItens = $carrinhoController->ObterCarrinho($_SESSION["codigo"]);

            if(count($carrinhoItens) <= 0)
            {
                echo "<script>alert('O carrinho não possui itens.')</script>";
                header("location:../index.php");
            }

            $valor_total = 0.0;
            foreach($carrinhoItens as $item)
            {
                $valor_total += $item->valor;
            }

            $pedidoController->AdicionarPedido($_SESSION["codigo"], $valor_total);
            $pedido = $pedidoController->ObterUltimoPedido($_SESSION["codigo"]);

            foreach($carrinhoItens as $item)
            {
                $pedidoController->AdicionarPedidoDetalhe($pedido[0]->codigo, $item);
            }
            
        }
    ?>
    <main class="form-signin w-50 m-auto col-sm-6" style="min-height: 100vh;">
        <div class="container">

            <form method="POST" action="#">
                <h1 class="h3 my-4 fw-normal">Preencha os dados do cartão de crédito</h1>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="cartao" name="cartao" placeholder="0000 0000 0000 0000">
                    <label for="cartao">Numero do cartão</label>
                </div>

                <div class="row g-2">
                    <div class="form-floating col-sm-6 pr-1 mb-2">
                        <input type="text" class="form-control" id="validade" name="validade" placeholder="00/00">
                        <label for="validade">Data de vencimento</label>
                    </div>

                    <div class="form-floating col-sm-6 pl-0 mb-2">
                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV">
                        <label for="cvv">CVV</label>
                    </div>
                </div>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Titular">
                    <label for="nome">Nome do titular</label>
                </div>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00">
                    <label for="cpf">CPF do titular</label>
                </div>

                <button class="w-100 btn btn-lg btn-success my-4" name="pagamento" type="submit">Efetuar pagamento</button>
            </form>

        </div>
    </main>


    <?php require_once "../footer.php" ?>

</body>

</html>