<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>NerdStore - Detalhes pedido</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body class="text-center">

  <?php 
    require_once "../header.php";
    require_once "../Controllers/MainController.php";
    require_once "../Controllers/PedidoController.php";

    $controller = new PedidoController();

    $usuarioAutenticado = $controller->UsuarioEstaAutenticado();

    if(!$usuarioAutenticado)
      header("location:login.php");

    if($_GET)
    {
      $codigoPedido = $_GET["pedido"];

      $pedido = $controller->ObterPedidoPorCodigo($codigoPedido);

      if(is_array($pedido))
      {
        
        if($pedido[0]->usuario != $_SESSION["codigo"])
        {
          header("location:../index.php");
        }
      }
    }

  ?>

  <div class="container m-auto" style="padding-top: 50px;min-height:100vh;">
    <div class="col-md-12" style="padding-bottom: 35px">
      <article class="card">
        <header class="card-header">
          <b class="d-inline-block mr-3">Pedido ID: <?php echo "#{$pedido->codigo}"; ?> <span class='badge text-bg-primary'>Aprovado</span></b>
        </header>
        <div class="card-body">
          <h6 class="text-muted">Pagamento</h6>
          <span class="text-success">
            <i class="fas fa-credit-card"></i>
            Cartão de crédito
          </span>
          <p style="margin-top: 20px">
          <?php
            $ValorFormatado = number_format($pedido->valor_total, 2, ',', '.');
            echo "<span class='b'>Total: R$ {$ValorFormatado}</span>";
          ?>
            
          </p>

          <hr>

          <div class="row">
          <?php 
            $pedidoDetalhe = $controller->ObterPedidoDetalhe($pedido->codigo);

            if(is_array($pedidoDetalhe) && count($pedidoDetalhe) > 0)
            {
              foreach($pedidoDetalhe as $item)
              {
                $valorFormatado = number_format($item->valor, 2, ',', '.');;
                $valorTotalFormatado = number_format($item->valor * $item_quantidade, 2, ',', '.');

                echo "<div class='col-md-4'>
                <figure class='itemside  mb-3'>
                  <div class='aside'>
                    <img src='produtos_imagens/{$item->foto}' width='40' height='40'
                      class='border img-xs'>
                  </div>
                  <figcaption class='info'>
                    <p>
                      <b>{$item->descricao}</b>
                    </p>
                    <span>{$item->quantidade}x R$ {$valorFormatado} = Total: R$ {$valorTotalFormatado} </span>
                  </figcaption>
                </figure>
              </div>";
              }
            }
          ?>
            

          </div>
        </div>
      </article>
    </div>
  </div>

  </div>

  <?php require_once "../footer.php"; ?>

</body>

</html>