<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li @if($current=="home" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/">Home</a>
      </li>

      <li @if($current=="pacientes" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/pacientes">Pacientes</a>
      </li>

      <li @if($current=="agenda" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/consultas">Agenda</a>
      </li>

      <li @if($current=="consultas" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/consultasporpaciente">Consultas</a>
      </li>

      <!--<li @if($current=="receitas" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/prontuarios">Receitas</a>
      </li>-->

      <li @if($current=="profissionais" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/profissionais">Profissionais</a>
      </li>

      <li @if($current=="convenios" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/convenios">Convênios</a>
      </li>

      <li @if($current=="especialidades" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/especialidades">Especialidades</a>
      </li>

      <li @if($current=="receituario" ) class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="/receituario">Receituário</a>
      </li>

    </ul>
  </div>

</nav>
