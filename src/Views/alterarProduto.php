<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Alterar Produto</title>
</head>
<body>

<div class="container py-5">
  <h1>Alterar Produto</h1>

  <form>
    <div class="form-group">
      <label for="exampleFormControlInput1">Descrição</label>
      <input type="text" class="form-control" id="descricao">
    </div>

    <div class="form-group">
      <label for="exampleFormControlInput1">Valor</label>
      <input type="text" class="form-control" id="valor">
    </div>

    <div class="form-group">
      <label for="exampleFormControlInput1">Estoque</label>
      <input type="number" class="form-control" id="estoque">
    </div>

    <div class="form-group">
      <label for="exampleFormControlTextarea1">Observação</label>
      <textarea class="form-control" id="observacao" rows="3"></textarea>
    </div>

    <div class="input-group mb-3 mt-2">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="foto">
      </div>
    </div>

    <div class="py-2 d-flex justify-content-end">
      <div class="d-flex">
        <button style="margin-right:10px;" type="button" class="btn btn-danger mb-2">Cancelar</button>
      <div>
      
      <div class="d-flex">
        <button type="submit" class="btn btn-success mb-2">Alterar</button>
      </div>
      
    </div>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>