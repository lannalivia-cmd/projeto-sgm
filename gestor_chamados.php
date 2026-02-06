<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
      </head>
<body>
        <header class="navbar" style= "background-color: LightSkyBlue;">
  <div class="container-fluid">
    <a class="navbar-brand">SGM| Admin</a>
    <form class="d-flex" role="search">
      
      <a class="navbar-brand">Olá Kauã!</a>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button class="btn btn-primary me-md-2" type="button">Chamados</button>
  <button class="btn btn-primary me-md-2" type="button">Locais</button>
  <button class="btn btn-primary" type="button">Sair</button>
</div>
</div>
    </form>
  </div>
</header>
   <nav></nav>

   <h2>Todos os chamados</h2>
   <main class="container w-100 mt-3">
    <button type="button" class="btn btn-outline-primary">Todos</button>
<button type="button" class="btn btn-outline-secondary">Abertos</button>
<button type="button" class="btn btn-outline-success">Em Execução</button>
<button type="button" class="btn btn-outline-danger">Concluídos</button>
        <div class="">
           <table class="table p-4">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">solicitante</th>
      <th scope="col">Local/tipo</th>
      <th scope="col">prioridade</th>
     <th scope="col">Técnico</th>
    <th scope="col">Status</th>
   <th scope="col">Ações</th>
   
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">#1</th>
      <td>Maria</td>
      <td>Bloco adinistrativo - Recepção</td>
      <td>vazando água na lâmpada</td>
      <td>06/02/2026</td>
      <td>Fechado</td>
      <td>Verificar</td>

    </tr>
  </tbody>
</table>
       
        </div>
        </div>
   </main>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>