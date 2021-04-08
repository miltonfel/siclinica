@extends('layouts.app', ["current" => "tiposusuarios"])

@section('body')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div>
        <!-- Tabela Principal apresentação -->
        <table class="table table-ordered table-hover" id="tabelaPacientes">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Tipo</th>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    function loading(carga) {
        console.log(carga);
        $('#dlgLoading').modal("hide");
    }



    function carregarPacientes(callback) {
        $("#tabelaPacientes>tBody").empty();
        $.getJSON('/api/listarusuarios', function(data) {
            for (i = 0; i < data.length; i++) {
                linha = montarLinha(data[i]);
                $('#tabelaPacientes>tBody').append(linha)
            }
            var carga = "Carga Concluída";
            callback(carga);
        });
    }

    function montarLinha(pac) {
        var linha = "<tr>" +
            "<td>" + pac.id + "</td>" +
            "<td>" + pac.name + "</td>" +
            "<td>" + pac.tipo + "</td>" +
            "<td>" +
            '<button class="btn btn-sm btn-primary" style="margin: 0 5px;" onclick="tornarProfissional(' + pac.id + ')">Tornar Profissional</button>' +
            '<button class="btn btn-sm btn-secondary" style="margin: 0 5px;" onclick="tornarAssistente(' + pac.id + ')">Tornar Assistente</button>' +
            '<button class="btn btn-sm btn-warning" style="margin: 0 5px;" onclick="tornarPaciente(' + pac.id + ')">Tornar Paciente</button>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function tornarProfissional(id) {
        console.log('Alterar Usuário ' + id + ' para profissional');
        $.post('/api/alterartipousuarios/' + id + '/profissional', function() {
            alert('Usuário alterado para profissional');
        });
        carregarPacientes(loading);
    }
    
    function tornarAssistente(id) {
        console.log('Alterar Usuário ' + id + ' para assistente');
        $.post('/api/alterartipousuarios/' + id + '/assistente', function() {
            alert('Usuário alterado para assistente');
        });
        carregarPacientes(loading);
    }

    function tornarPaciente(id) {
        console.log('Alterar Usuário ' + id + ' para paciente');
        $.post('/api/alterartipousuarios/' + id + '/paciente', function() {
            alert('Usuário alterado para paciente');
        });
        carregarPacientes(loading);
    }

    $(function() {
        $('#dlgLoading').modal("show");
        carregarPacientes(loading);
    })
</script>

@endsection