<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>NerdStore - Cadastro</title>

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
        require_once "../Models/Endereco.class.php";
        require_once "../Models/Usuario.class.php";
        require_once "../Controllers/MainController.php";
        require_once "../Controllers/UsuarioController.php";
        $controller = new UsuarioController();

        $usuarioAutenticado = $controller->UsuarioEstaAutenticado();

        if($usuarioAutenticado)
          header("location:../index.php");

        if(isset($_POST["cadastrar"]))
        {
          $senha = $_POST["senha"];
          $confirmarSenha = $_POST["confirmarSenha"];

          if($senha != $confirmarSenha)
            echo "<script>alert('As senhas não conferem.')</script>";

          $usuario = new Usuario
          (
            nome: $_POST["nome"],
            email: $_POST["email"],
            senha: md5($_POST["senha"]),
            tipo_usuario: 1,
            ativo: true,
            endereco: new Endereco
            (
              logradouro: $_POST["logradouro"],
              numero: $_POST["numero"],
              bairro: $_POST["bairro"],
              cidade: $_POST["cidade"],
              cep: $_POST["cep"],
              uf: $_POST["uf"],
              complemento: $_POST["complemento"]
            )
          );

          $controller->CadastrarUsuario($usuario);
        }

  ?>
    
<main class="form-signin w-50 m-auto col-sm-6">
  <div class="container">

    <form action="#" method="POST">
      <h1 class="h3 my-4 fw-normal">Criar conta</h1>

      <div class="form-floating mb-2">
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Seu nome">
        <label for="nome">Nome</label>
      </div>

      <div class="form-floating mb-2">
        <input type="email" class="form-control" name="email" id="email" placeholder="nome@exemplo.com">
        <label for="email">Email</label>
      </div>

      <!-- Endereço -->
      <div class="row g-2">
        <div class="form-floating col-sm-9 pr-1 mb-2">
          <input type="text" class="form-control" name="logradouro" id="logradouro" placeholder="Logradouro">
          <label for="logradouro">Logradouro</label>
        </div>

        <div class="form-floating col-sm-3 pl-0 mb-2">
          <input type="number" class="form-control" name="numero" id="numero" placeholder="Número">
          <label for="numero">Número</label>
        </div>
      </div>

      
      <div class="form-floating mb-2">
        <input type="text" class="form-control" name="complemento" id="complemento" placeholder="Complemento">
        <label for="complemento">Complemento</label>
      </div>

      <div class="form-floating mb-2">
        <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro">
        <label for="bairro">Bairro</label>
      </div>

      <div class="form-floating mb-2">
        <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade">
        <label for="cidade">Cidade</label>
      </div>

      <div class="row g-2">
        <div class="form-floating col-sm-6 mb-2">
          <input type="text" class="form-control" name="cep" id="cep" placeholder="Cep">
          <label for="cep">Cep</label>
        </div>

        <div class="form-floating col-sm-6 mb-2">
          <input type="text" class="form-control" name="uf" id="uf" placeholder="Uf">
          <label for="uf">Uf</label>
        </div>
      </div>

      <div class="form-floating mb-2">
        <input type="password" class="form-control" name="senha" id="senha" placeholder="sua senha">
        <label for="senha">Senha</label>
      </div>

      <div class="form-floating mb-2">
        <input type="password" class="form-control" name="confirmarSenha" id="confirmarSenha" placeholder="confirme sua senha">
        <label for="confirmarSenha">Confirme sua senha</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary my-4" name="cadastrar" type="submit">Cadastrar</button>
      <div class="d-flex">
          <p style="margin-right:5px;">Já possui uma conta? </p>
          <a href="">Faça Login.</a>
      </div>
    </form>

  </div>
</main>


    
  </body>
</html>