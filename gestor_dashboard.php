<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <title>Document</title>
</head>
<body>
 <header>
    <div class="p-3 text-primary-emphasis --bs-dark-bg-subtle-subtle border border-primary-subtle rounded-3">
  SGM | Gestão Administrativa
</div>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button> <a href="api/logout.php" class="btn bg-light" type="submit">Sair</a></button>
  
</div>
</div>
</div>
 </header>
 <nav>
<div class="row">
  <div class="col-sm-4 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Novas solicitações</h5>
        <p class="card-text">0</p>
      </div>
    </div>
  </div>

  <div class="col-sm-4 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Em atendimento</h5>
        <p class="card-text">0</p>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Críticos/ Urgentes</h5>
        <p class="card-text">0</p>
      </div>
    </div>
  </div>
</div>
  <div class="d-grid gap-2 d-md-block">
  <button class="btn btn-primary"><i class="bi bi-geo-alt"></i>Gerenciar todos os chamados</button>
  <button class="btn btn-primary" type="button">Gerenciar localização</button>
</div>
</nav>
 <main></main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>  
</body>
</html>