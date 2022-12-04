<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>NerdStore - Detalhes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  </head>
        
<body class="text-center">

  <?php 
    require_once "../header.php"; 
    require_once "../Controllers/MainController.php";
    require_once "../Controllers/ProdutoController.php";
  ?>
    
  <div class="container m-auto" style="padding-top: 20px;min-height:100vh;">
  
    <?php
        if($_GET)
        {
            $codigo = $_GET["codigo"];
            $controller = new ProdutoController();

            $produto = $controller->ObterProdutoPorCodigo($codigo);

            if(is_array($produto))
            {
                $valorFormatado = number_format($produto[0]->valor, 2, ',', '.');
                echo "<div class='card'>
                <div class='row no-gutters'>
                    <aside class='col-md-6'>
                        <article class='gallery-wrap'>
                            <div class='img-big-wrap' style='text-align: center'>
                                <img src='produtos_imagens/{$produto[0]->foto}' width='400'>
                            </div>
                        </article>
                    </aside>
                    <main class='col-md-6 border-left'>
                        <article class='content-body'>
                            <form method='post' action='/shopping-cart/add-item'>
                            <h2 class='title'>{$produto[0]->descricao}</h2>     
          
                                <div class='mb-3'>
                                    <var class='price h4'>R$ {$valorFormatado}</var>
                                </div>";

                if($produto[0]->estoque > 0){
                    echo "<h5>{$produto[0]->observacao}</h5><br/>
                    <p> Apenas {$produto[0]->estoque} em estoque!</p>
                    <hr>

                        <div class='form-row'>
                            <div class='form-group col-md flex-grow-0'>
                                <label>Quantidade</label>
                                <div class='input-group input-spinner'>
                                    <select id='quantidade' name='quantidade' class='form-control'>
                                        <option value='1'>1</option>
                                        <option value='2'>2</option>
                                        <option value='3'>3</option>
                                        <option value='4'>4</option>
                                        <option value='5'>5</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <br/>
                        <button type='submit' class='btn btn-primary'>
                            <span class='text'>Adicionar ao Carrinho</span> <i class='fas fa-shopping-cart'> &nbsp;</i>
                        </button>

                                        <a class='btn  btn-info' href='../index.php'>
                                            <span class='text'>Voltar</span>
                                        </a>
                                </article>
                            </main>
                        </div>
                    </div>";
                }
                                
          
                
                
                else
                {
                    echo "<hr>
                                    <p> Sem Estoque!</p>
                                        <br/>
          
                                <a class='btn  btn-info' href='../index.php'>
                                    <span class='text'>Voltar</span>
                                </a>
                        </article>
                    </main>
                </div>
              </div>";
                }
            }
        }

    ?>
    

  </div>

<?php require_once "../footer.php" ?>

</body>
</html>