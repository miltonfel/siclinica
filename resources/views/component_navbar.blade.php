<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
  
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mr-auto">
        <li @if($current=="home") class="nav-item active" @else class="nav-item" @endif>
          <a class="nav-link" href="/">Home</a>
        </li>

        <li @if($current=="pacientes") class="nav-item active" @else class="nav-item" @endif>
          <a class="nav-link" href="/pacientes">Pacientes</a>
        </li>

        <li @if($current=="consultas") class="nav-item active" @else class="nav-item" @endif>
          <a class="nav-link" href="/consultas">Consultas</a>
        </li>

        <li @if($current=="exames") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="/exames">Exames</a>
        </li>

        <li @if($current=="receitas") class="nav-item active" @else class="nav-item" @endif>
          <a class="nav-link" href="/receitas">Receitas</a>
        </li>

        <li @if($current=="prontuarios") class="nav-item active" @else class="nav-item" @endif>
          <a class="nav-link" href="/prontuarios">Prontuários</a>
        </li>

        <!-- Example single danger button -->       
        
    </ul>
    </div>
    
  </nav>
  <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown link
  </a>

  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div>