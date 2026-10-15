<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="{{ route('dashboard') }}">Pausa Sofás</a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('fornecedores.index') }}">Fornecedores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('sofas.index') }}">Sofás</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('vendas.index') }}">Vendas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('fichas.index') }}">Fichas Técnicas</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
