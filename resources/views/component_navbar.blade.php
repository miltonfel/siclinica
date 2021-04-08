<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <!-- Item aberto a todos acessos-->
      <li @if($current=="home" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/">Home</a>
      </li>

      @auth('web')
      <!-- Item aberto aos usuários pacientes-->
      @if (Auth::user()->tipo=="paciente")
      <li @if($current=="consultas" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/consultasporpaciente">Consultas</a>
      </li>
      @endif

      @if (Auth::user()->tipo=="profissional" || Auth::user()->tipo=="assistente")
      <!-- Itens abertos aos usuários profissionais e assistentes-->
      <li @if($current=="pacientes" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/pacientes">Pacientes</a>
      </li>

      <li @if($current=="agenda" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/consultas">Agenda</a>
      </li>

            <!-- Itens abertos aos usuários profissionais apenas-->
        
      @if (Auth::user()->tipo=="profissional")
      <li @if($current=="convenios" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/convenios">Convênios</a>
      </li>

      <li @if($current=="especialidades" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/especialidades">Especialidades</a>
      </li>

      <li @if($current=="receituario" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/receituario">Receituário</a>
      </li>

      <li @if($current=="exames" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/exames">Exames</a>
      </li>
      @endif
      @endif
      @endauth

      <!-- Itens abertos aos admins-->
      @auth('admin')
      <li @if($current=="profissionais" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/profissionais">Profissionais</a>
      </li>

      <li @if($current=="tipos" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/tiposconsultas">Tipos Consulta</a>
      </li>

      <li @if($current=="tiposusuarios" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/tiposusuarios">Tipos Usuários</a>
      </li>

      <!--<li @if($current=="estabelecimento" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/estabelecimento">Estabelecimento</a>
      </li>-->
      @endauth



    </ul>
  </div>

</nav>