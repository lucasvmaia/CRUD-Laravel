<nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 mb-5 rounded bg-light">
    <div class="container-fluid">

      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a @if($current=="home") class="nav-link active" @else class="nav-link" @endif href="/">Home</a>
          <a @if($current=="usuarios") class="nav-link active" @else class="nav-link" @endif href="/usuarios">Usuários</a>
          <a @if($current=="afiliados") class="nav-link active" @else class="nav-link" @endif href="/afiliados">Afiliados</a>
          <a @if($current=="comissoes") class="nav-link active" @else class="nav-link" @endif href="/comissoes">Comissões</a>
        </div>
      </div>
    </div>
</nav>