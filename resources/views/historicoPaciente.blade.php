
@extends('layouts.app', ["current" => "consultas"])

@section('body')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div>

        <!-- Tabela Principal -->
        <table class="table table-ordered table-hover" id="tabelaConsultas">
            <h4> Consultas de <div id='nomePaciente'>{{ $id }}</div> </h4>
            <input type="hidden" id="idPaciente" value="{{ $id }}" class="form-control">
            <thead>
                <tr>
                    <!--<th>#</th>-->
                    <th>Profissional</th>
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
        //console.log(dataConsultas);
        $.getJSON('/api/consultaPorPaciente/'+$('#idPaciente').val(), function(data) {
            $("#tabelaConsultas>tBody").empty();
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
        mes = con.agendamento.substring(5, 7);
        ano = con.agendamento.substring(0, 4);
        data = dia + "/" + mes + "/" + ano;

        horario = con.agendamento;
        hora = con.agendamento.substring(11, 13);
        minuto = con.agendamento.substring(14, 16);
        horario = hora + ":" + minuto;

        var linha = "<tr>" +
            " <!--<td>" + con.id + "</td>-->" +
            "<td>" + con.profissional.name+ "</td>" +
            "<td>" + data + " - " + horario + "</td>" +
            "<td>" + con.status + "</td>" +
            "<td>" +
            '<a class="btn btn-sm btn-primary" style="margin: 0 5px;" href="../consulta_detalhe/' + con.id + '">Acessar</a>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function carregarDadosPaciente(){
        $.getJSON('/api/pacientes/'+$('#idPaciente').val(), function(data) {
            console.log(data[0].name);
            $('#nomePaciente').text(data[0].name);
        });
    }



    function recarregaPagina() {
        document.location.reload(true);
    }

    $(function() {
        //$('#dlgLoading').modal("show");
        carregarConsultas(loading);
        carregarDadosPaciente();        
        setInterval(function() {
            carregarConsultas(loading);
        }, 60000);
    })
</script>

@endsection