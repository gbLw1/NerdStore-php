<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Cadastrar Produto</title>
</head>
<body>

<?php
        require_once "../Models/Produto.class.php";
        require_once "../Controllers/MainController.php";
        require_once "../Controllers/ProdutoController.php";

        $controller = new ProdutoController();

        $usuarioAutenticado = $controller->UsuarioEstaAutenticado();
        $usuarioAdm = $controller->UsuarioAdm();

        if($usuarioAutenticado && $usuarioAdm)
        {
          // verifica se o formulário foi submetido
          // através do atributo "name" do button
          if(isset($_POST["cadastrar"]))
          {
            // preencher args do produto
            $produto = new Produto
            (
              descricao: $_POST["descricao"],
              valor: floatval(str_replace(",", ".", $_POST["valor"])),
              estoque: intval($_POST["estoque"]),
              ativo: true,
              observacao: $_POST["observacao"],
              foto: $_FILES["foto"]["name"],
              fotoArquivo: $_FILES["foto"]
            );
  
            // func: cadastrar produto (controller)
            $controller->CadastrarProduto($produto);
          }
        }
        else
        {
          header("location:../index.php");
        }

  ?>

<div class="container py-5">
  <h1>Cadastro de Produto</h1>

  <form action="#" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="exampleFormControlInput1">Descrição</label>
      <input type="text" class="form-control" name="descricao" id="descricao">
    </div>

    <div class="form-group">
      <label for="exampleFormControlInput1">Valor</label>
      <input type="text" class="form-control" name="valor" id="valor">
    </div>

    <div class="form-group">
      <label for="exampleFormControlInput1">Estoque</label>
      <input type="number" class="form-control" name="estoque" id="estoque">
    </div>

    <div class="form-group">
      <label for="exampleFormControlTextarea1">Observação</label>
      <textarea class="form-control" name="observacao" id="observacao" rows="3"></textarea>
    </div>

    <div class="input-group mb-3 mt-2">
      <div class="custom-file">
        <input type="file" class="custom-file-input" name="foto" id="foto" accept="image/*">
      </div>
      <div class="form-group">
          <img src="" id="imgPreview">
      </div>
    </div>

    <div class="py-2 d-flex justify-content-end">
      <div class="d-flex">
        <a href="painel-adm.php" style="margin-right:10px;" class="btn btn-danger mb-2">Cancelar</a>
      <div>
      
      <div class="d-flex">
        <button class="btn btn-primary mb-2" name="cadastrar" type="submit">Cadastrar</button>
      </div>
      
    </div>
  </form>
</div>
<script>
  foto.onchange = evt => {
    const [file] = foto.files
    if(file){
      imgPreview.src = URL.createObjectURL(file)
    } 
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>