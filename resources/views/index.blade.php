@extends('layouts.app', ["current" => "home"])

@section('body')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Bem Vindo(a)!</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          Seja bem vindo(a) ao Sistema de Gerenciamento de clínica<br>
          Para iniciar, faça seu login

          <div>
            @guest
            <a class="btn btn-primary btn-lg btn-block" href="/login">Login</a>
            <a class="btn btn-secondary btn-lg btn-block" href="/register">Registrar</a>
            @endif

          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection