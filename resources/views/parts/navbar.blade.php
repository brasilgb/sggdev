
<nav class="navbar navbar-expand-lg navbar-dark bg-blue-nav border-bottom border-white shadow-sm mx-auto">

    <div class="container ">
    <a class="navbar-brand" href="{{ route('home') }}">
        @if($empresaexist->logotipo)
            <img src="{{ url("storage/thumbnail/{$empresaexist->logotipo}") }}"  height="30" alt="" class="rounded">
            @else
            <img src="{{ url("storage/empresa/sggaicon.png") }}"  height="30" alt="" class="rounded">
            @endif
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >

      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('periodos*')) ? 'active' : '' }}" href="{{ route('periodos.index') }}">Períodos</a>
          </li>
          <li class="nav-item dropdown">
            <a class="@if(!$periodo) disabled @endif nav-link dropdown-toggle {{ (request()->is('lotes*', 'aviarios*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Lotes/Aviários
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('lotes.index') }}"><i class="fa fa-angle-right"></i> Lotes</a>
              <a class="dropdown-item" href="{{ route('aviarios.index') }}"><i class="fa fa-angle-right"></i> Aviários</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="@if(!$periodo) disabled @endif nav-link" href="{{ route('coletas.index') }}">Coletas</a>
          </li>

          <li class="nav-item dropdown">
            <a class="@if(!$periodo) disabled @endif nav-link dropdown-toggle {{ (request()->is('envios*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Ovos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('envios.index')}}"><i class="fa fa-angle-right"></i> Envio</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="@if(!$periodo) disabled @endif nav-link dropdown-toggle {{ (request()->is('mortalidades*','pesagens*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Aves
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{route('mortalidades.index') }}"><i class="fa fa-angle-right"></i> Mortalidade</a>
              <a class="dropdown-item" href="{{route('pesagens.index') }}"><i class="fa fa-angle-right"></i> Pesagem</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="@if(!$periodo) disabled @endif nav-link dropdown-toggle {{ (request()->is('recebimentos*','consumos*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Ração
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('recebimentos.index') }}"><i class="fa fa-angle-right"></i> Recebimento</a>
              <a class="dropdown-item" href="{{ route('consumos.index')}}"><i class="fa fa-angle-right"></i> Consumo</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="@if(!$periodo) disabled @endif nav-link dropdown-toggle {{ (request()->is('geraltarefas*','controlediarios*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Tarefas
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('geraltarefas.index') }}"><i class="fa fa-angle-right"></i> Tarefas gerais</a>
              <a class="dropdown-item" href="{{ route('controlediarios.index') }}"><i class="fa fa-angle-right"></i> Controle diário</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="@if(!$periodo) disabled @endif nav-link dropdown-toggle {{ (request()->is('despesas*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Financeiro
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('despesas.index') }}"><i class="fa fa-angle-right"></i> Despesas</a>
                <a class="dropdown-item" href="{{ route('financeiros.index') }}"><i class="fa fa-angle-right"></i> Entradas</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="@if(!$periodo) disabled @endif nav-link dropdown-toggle {{ (request()->is('metas*')) ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
              <a class="dropdown-item" href="{{ route('usuarios.index') }}"><i class="fa fa-angle-right"></i> Usuários</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="@if(!$periodo) disabled @endif nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Relatórios
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('relatorios.movimentodiario') }}"><i class="fa fa-caret-right"></i> Movimento diário</a>
              <a class="dropdown-item" href="{{ route('relatorios.coleta') }}"><i class="fa fa-caret-right"></i> Coleta</a>
              <a class="dropdown-item" href="{{ route('relatorios.financeiro') }}"><i class="fa fa-caret-right"></i> Financeiro</a>
              <a class="dropdown-item" href="{{ route('relatorios.estoqueave') }}"><i class="fa fa-caret-right"></i> Estoque aves</a>
              <a class="dropdown-item" href="{{ route('relatorios.estoqueovo') }}"><i class="fa fa-caret-right"></i> Estoque ovos</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('usuarios.edit', ['usuario' => Auth::user()->id]) }}"><i class="fa fa-caret-right"></i> {{ Auth::user()->name }}</a>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-caret-right"></i> Sair</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
            </div>
          </li>

      </ul>
    </div>
    </div>
  </nav>
