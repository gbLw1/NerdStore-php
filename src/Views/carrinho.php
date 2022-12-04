<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>NerdStore - Carrinho</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body class="text-center">

    <?php 
    
        require_once "header.php";
        require_once "../Controllers/MainController.php"; 
        require_once "../Controllers/CarrinhoController.php";

        $controller = new CarrinhoController();

        $usuarioAutenticado = $controller->UsuarioEstaAutenticado();

        if(!$usuarioAutenticado)
            header("location:login.php");

        if(isset($_POST["removerItem"]))
        {
            $codigoProduto = $_POST["produto"];
            $controller->RemoverItem($_SESSION["codigo"], $codigoProduto);
        }

        if(isset($_POST['atualizarQuantidade']))
        {
            $codigoProduto = $_POST["produto"];
            $quantidade = $_POST["quantidade"];

            $controller->AtualizarItemQuantidade($_SESSION["codigo"], $codigoProduto, $quantidade);
        }
    
    ?>

    <div class="container m-auto" style="padding-top: 50px;min-height:100vh;">
        <div class="row">
            <main class="col-md-9">
                <div class="card p-4">

                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col">Produto</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                            $carrinhoItens = $controller->ObterCarrinhoItens($_SESSION["codigo"]);
                            $valorTotalCarrinho = $controller->ObterValorTotalCarrinho($_SESSION["codigo"]);

                            if(is_array($carrinhoItens) && count($carrinhoItens) > 0)
                            {
                                foreach($carrinhoItens as $item)
                                {

                                    $valorTotalItemFormatado = number_format($item->valor * $item->quantidade, 2, ',', '.');
                                    $valorItemFormatado = number_format($item->valor, 2, ',', '.');

                                    echo "<tr>
                                    <td>
                                        <figure class='itemside'>
                                            <div class='aside'>
                                                <img src='produtos_imagens/{$item->produtoFoto}'
                                                    alt='produto' width='80' height='80' class='img-sm'>
                                            </div>
                                            <figcaption class='info'>
                                                <a href='detalhes-produto.php?id={$item->produtoCodigo}'>
                                                    <h6 style='padding-top: 10px' class='title text-dark'>{$item->descricao}</h6>
                                                </a>
                                                <p class='text-muted small'>qtde. {$item->quantidade}</p>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td>
                                        <div class='price-wrap'>
                                            <var class='price'>R$ {$valorTotalItemFormatado}</var>
                                            <small class='text-muted'>R$ {$valorItemFormatado} cada</small>
                                        </div>
                                    </td>
                                    <form method='post' action='#'>
                                        <input type='hidden' value='{$item->produtoCodigo}' name='produto' />
                                        <td>
                                            <select id='Quantidade' id='qtde' name='quantidade' class='form-select'>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class='text-right'>
                                                <button type='submit' name='atualizarQuantidade' class='btn btn-success'>
                                                    <i class='fas fa-sync'></i>
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                    <td>
                                        <form method='post' action='#'>
                                        <input type='hidden' value='{$item->produtoCodigo}' name='produto' />
                                            <div>
                                                <button type='submit' name='removerItem' class='btn btn-danger'>
                                                    <i class='fas fa-trash-alt'></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>";
                                }
                            }
                        ?>

                        </tbody>
                    </table>
                        <?php
                         
                            if(count($carrinhoItens) <= 0)
                            {
                                echo "<div class='card-body border-top'>
                                <a class='btn btn-primary disabled float-md-right' role='button' aria-disabled='true'>
                                    Finalizar Compra <i class='fa fa-chevron-right'></i> </a>
                                <a class='btn btn-light' href='index.php'>
                                    <i class='fa fa-chevron-left'></i> Continuar Comprando
                                </a>
                            </div>";
                            }

                            else
                            {
                                echo "<div class='card-body border-top'>
                                <a class='btn btn-primary float-md-right' href='pagamento.php'>
                                    Finalizar Compra <i class='fa fa-chevron-right'></i> </a>
                                <a class='btn btn-light' href='index.php'>
                                    <i class='fa fa-chevron-left'></i> Continuar Comprando
                                </a>
                            </div>";
                            }
                         ?>
                    
                </div>


            </main>
            <aside class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right h5">
                                <strong>
                                    <?php
                                        $valorTotalFormatado = number_format($valorTotalCarrinho, 2, ',', '.'); 
                                        echo "R$ {$valorTotalFormatado}"; 
                                    ?>
                                </strong>
                            </dd>
                        </dl>
                        <hr>
                        <p class="text-center mb-3">
                            <img src="img/payments.png" height="26">
                        </p>

                    </div>
                </div>

            </aside>
        </div>
    </div>

    <?php require_once "footer.php" ?>

</body>

</html>