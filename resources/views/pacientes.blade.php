@extends('layouts.app', ["current" => "pacientes"])

@section('body')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div>
        <!-- Tabela Principal apresentação -->
        <table class="table table-ordered table-hover" id="tabelaClientes">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Convênio</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Alimentado via JQuery-->
            </tbody>
        </table>

    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onclick=novoPaciente()>Cadastrar Paciente</a>
    </div>

</div>

@endsection

@section('javascript')
<script type="text/javascript">
    console.log("Javascript em funcionamento")
</script>
@endsection