@extends('layouts.app', ["current" => "consultas"])

@section('body')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div>
        <!-- Tabela Principal apresentação -->
        <table class="table table-ordered table-hover" id="tabelaConsultas">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Paciente</th>
                    <th>Data / Horário</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Alimentado via JQuery-->
            </tbody>
        </table>

    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onclick=novaConsulta()>Nova Consulta</a>
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

    function carregarConsultas(callback) {
        $.getJSON('/api/consultas', function(data) {
            for (i = 0; i < data.length; i++) {
                linha = montarLinha(data[i]);
                $('#tabelaConsultas>tBody').append(linha)
            }
            var carga = "Carga Concluída";
            callback(carga);
        });
    }

    function montarLinha(con) {
        data = con.agendamento;
        dia = con.agendamento.substring(8, 10);
        mes = con.agendamento.substring(5,7);
        ano = con.agendamento.substring(0, 4);
        data = dia+"/"+mes+"/"+ano;

        horario = con.agendamento;
        hora = con.agendamento.substring(11, 13);
        minuto = con.agendamento.substring(14,16);
        horario = hora+":"+minuto;

        var linha = "<tr>" +
            "<td>" + con.id + "</td>" +
            "<td>" + con.paciente.nome + "</td>" +
            "<td>" + data + " - "+horario + "</td>" +
            "<td>" + con.status + "</td>" +
            "<td>" +
            '<button class="btn btn-sm btn-primary" style="margin: 0 5px;" onclick="editar(' + con.id + ')">Editar</button>' +
            '<button class="btn btn-sm btn-secondary" style="margin: 0 5px;" onclick="editar(' + con.id + ')">Prontuário</button>' +
            '<button class="btn btn-sm btn-danger" style="margin: 0 5px;" onclick="confirmaExclusao(' + con.id + ',\'' + con.nome + '\')">Excluir</button>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    $(function() {
        //$('#dlgLoading').modal("show");
        carregarConsultas(loading);
    })
</script>

@endsection