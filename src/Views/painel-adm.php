<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>NerdStore - Produtos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  </head>
        
<body class="text-center">

  <?php 
    require_once "header.php";
    require_once "../Controllers/MainController.php";
    require_once "../Controllers/ProdutoController.php";

    $controller = new ProdutoController();
    $usuarioAutenticado = $controller->UsuarioEstaAutenticado();
    $usuarioAdmin = $controller->UsuarioAdm();
    if($usuarioAutenticado && !$usuarioAdmin || !$usuarioAutenticado)
    {
      header("location:index.php");
    }
  ?>
    
  <div class="container m-auto" style="min-height:100vh;">
    <div class="row">
      <h1 style="margin-top: 20px;">Dashboard</h1>
      <h4>Produtos</h4>
    </div>

    <div class="row d-flex align-items-center">
      <div class="col-sm-6 d-flex justify-content-start">
        <a class="btn btn-primary" style="margin: 10px 0" href="cadastroProduto.php" role="button">Cadastrar</a>
      </div>
    </div>

    <div class="row">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Descrição</th>
            <th scope="col">Estoque</th>
            <th scope="col">Valor</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php
            $produtos = $controller->ObterListaProdutosAtivos();

            if(is_array($produtos) && count($produtos))
            {
              foreach($produtos as $produto)
              {
                $valorFormatado = number_format($produto->valor, 2 , ',', '.');
                echo "<tr>
                <th scope='row'>{$produto->codigo}</th>
                <td>{$produto->descricao}</td>
                <td>{$produto->estoque}</td>
                <td>R$ {$valorFormatado}</td>
                <td>
                  <a href='alterarProduto.php?id={$produto->codigo}' class='btn btn-info'><i class='far fa-edit'></i></a>
                  <a href='excluirProduto.php?id={$produto->codigo}' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a>
                </td>
              </tr>";
              }
            }
          ?>
          
        </tbody>
      </table>
  </div>

</div>

<?php require_once "footer.php" ?>

</body>
</html>