<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>NerdStore - Cadastro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  </head>


<body class="text-center">

  <?php 
    require_once "header.php";
    require_once "../Controllers/MainController.php";
    require_once "../Controllers/ProdutoController.php";
  ?>

  <div class="container m-auto" style="padding-top: 10px;min-height:100vh;">
    <div class="row">
    <?php
      $controller = new ProdutoController();
      $listaProdutos = $controller->ObterListaProdutosAtivos();

      if(is_array($listaProdutos))
      {
        foreach($listaProdutos as $produto)
        {
          $valorFormatado = number_format($produto->valor, 2, ',', '.');
          echo "<div class='col-md-3 pt-5'>
            <div class='card card-product-grid' style='width: 18rem;'>
              <a href='detalhes-produto.php?id={$produto->codigo}' style='text-transform: none;'>
                <img src='produtos_imagens/{$produto->foto}' class='card-img-top' alt='...'>
              </a>
              <div class='card-body'>
                <h5 class='card-title'>{$produto->descricao}</h5>
                <p class='card-text'>{$produto->observacao}</p>
                <div class='d-flex justify-content-center align-items-center'>
                  <p class='btn btn-success' style='margin: 0 5px 0 0;'><b>R$ {$valorFormatado}</b></p>
                  <a href='detalhes-produto.php?id={$produto->codigo}' class='btn btn-primary'>Ver produto</a>
                </div>
              </div>
            </div>
          </div>";
        }
      }
    ?>

    </div>

    <div class="py-5"></div>
  </div>

  <?php require_once "footer.php" ?>
    
</body>
</html>