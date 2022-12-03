<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>NerdStore - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        body{
            display:flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
    </style>

  </head>
  <body class="text-center">

    <?php 
        require_once "../../Controllers/UsuarioController.php";
        if($_POST)
        {
            $controller = new UsuarioController();
            $controller->Login($_POST["email"], md5($_POST["senha"]));
        }
    ?>

<main class="form-signin w-25 m-auto col-sm-6">
    <div class="container">
  <form action="#" method="POST">
    
    <h1 class="h3 mb-3 fw-normal">NerdStore</h1>

    <div class="form-floating mt-2">
      <input type="email" class="form-control" id="email" placeholder="nome@exemplo.com">
      <label for="email">Email</label>
    </div>
    <div class="form-floating my-2">
      <input type="password" class="form-control" id="senha" placeholder="sua senha">
      <label for="senha">Senha</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
    <div class="d-flex">
        <p style="margin-right:5px;">Não possui uma conta? </p>
        <a href="">Clique Aqui</a>
    </div>
  </form>

  </div>
</main>


    
  </body>
</html>