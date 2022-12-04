<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>NerdStore - Pedidos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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

?>
    
  <div class="container m-auto" style="min-height:100vh;">
    <div class="row">
      <h1 class="d-flex" style="margin-top: 20px;">Meus pedidos</h1>
    </div>

    <div class="row">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"># Pedido</th>
            <th scope="col">Valor Total</th>
            <th scope="col">Ação</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php 
              $pedidos = $controller->ObterPedidos($_SESSION["codigo"]);

              if(is_array($pedidos) && count($pedidos) > 0)
              {                
                  foreach($pedidos as $pedido)
                  {
                    $valorFormatado = number_format($pedido->valor_total, 2, ',', '.');
                    echo "<tr>
                    <th>{$pedido->codigo}</th>
                    <td>R$ {$valorFormatado}</td>
                    <td>
                      <a class='btn btn-primary' href='detalhes-pedido.php?pedido={$pedido->codigo}' role='button'>Detalhes</a>
                    </td>
                  </tr>";
                  }
              }
          ?>        
        </tbody>
      </table>
  </div>

</div>

<?php require_once "../footer.php"; ?>

</body>
</html>