
<nav class="navbar navbar-expand-lg navbar-dark bg-blue-nav border-bottom border-white shadow-sm mx-auto">
    <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('periodos*')) ? 'active' : '' }}" href="{{ route('periodos.index') }}">Períodos</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (request()->is('lotes*', 'aviarios*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Lotes/Aviários
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('lotes.index') }}"><i class="fa fa-angle-right"></i> Lotes</a>
              <a class="dropdown-item" href="{{ route('aviarios.index') }}"><i class="fa fa-angle-right"></i> Aviários</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('coletas.index') }}">Coletas</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (request()->is('envios*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Ovos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('envios.index')}}"><i class="fa fa-angle-right"></i> Envio</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (request()->is('mortalidades*','pesagens*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Aves
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{route('mortalidades.index') }}"><i class="fa fa-angle-right"></i> Mortalidade</a>
              <a class="dropdown-item" href="{{route('pesagens.index') }}"><i class="fa fa-angle-right"></i> Pesagem</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (request()->is('recebimentos*','consumos*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Ração
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('recebimentos.index') }}"><i class="fa fa-angle-right"></i> Recebimento</a>
              <a class="dropdown-item" href="{{ route('consumos.index')}}"><i class="fa fa-angle-right"></i> Consumo</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (request()->is('geraltarefas*','controlediarios*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Tarefas
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('geraltarefas.index') }}"><i class="fa fa-angle-right"></i> Tarefas gerais</a>
              <a class="dropdown-item" href="{{ route('controlediarios.index') }}"><i class="fa fa-angle-right"></i> Controle diário</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (request()->is('despesas*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Financeiro
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('despesas.index') }}"><i class="fa fa-angle-right"></i> Despesas</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (request()->is('metas*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Metas
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('metas.eclosao') }}"><i class="fa fa-angle-right"></i> Eclosão</a>
              <a class="dropdown-item" href="{{ route('metas.fertilidade') }}"><i class="fa fa-angle-right"></i> Fertilidade</a>
              <a class="dropdown-item" href="{{ route('metas.producao') }}"><i class="fa fa-angle-right"></i> Produção</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ (request()->is('empresas*', 'backups*', 'emails*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Configurações
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('empresas.index') }}"><i class="fa fa-angle-right"></i> Empresa</a>
              <a class="dropdown-item" href="{{ route('emails.index') }}"><i class="fa fa-angle-right"></i> E-mail</a>
              <a class="dropdown-item" href="{{ route('backups.index') }}"><i class="fa fa-angle-right"></i> Backup</a>
              <a class="dropdown-item" href="#"><i class="fa fa-angle-right"></i> Usuários</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Relatórios
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#"><i class="fa fa-caret-right"></i> Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Perfil</a>
              <a class="dropdown-item" href="#">Sair</a>
            </div>
          </li>

      </ul>
    </div>
    </div>
  </nav>
