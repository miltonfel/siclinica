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
            <h4> Consultas de {{ Auth::user()->name }} </h4>
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

<div class="modal" tabindex="-1" role="dialog" id="dlgDeleteConfirm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                 <input type="hidden" id="idPaciente" value="{{ Auth::user()->id }}" class="form-control">
                <input type="hidden" id="idConsultaCancelamento" class="form-control">
                <h5 class="modal-title">Confirmação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mensagemConfirmacao">
                <p>Confirmação aqui?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick=cancelarConsulta($('#idConsultaCancelamento').val())>Sim</button>
            </div>
        </div>
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
            '<button class="btn btn-sm btn-success" style="margin: 0 5px;" onclick="confirmaConsulta(' + con.id + ')">Confirmar</button>' +
            '<button class="btn btn-sm btn-danger" style="margin: 0 5px;" onclick="confirmaCancelamento(' + con.id + ')">Cancelar</button>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function confirmaCancelamento(id) {
        console.log("Confirmação exclusão da consulta");
        $('#idConsultaCancelamento').val(id);
        $('#mensagemConfirmacao').text("Confirma o cancelamento da consulta?");
        $('#dlgDeleteConfirm').modal('show')
    }

    function confirmaConsulta(id) {
        $.post('/api/confirmarConsulta/' + id, function(data) {
            alert(data);
        });
        carregarConsultas(loading);

    }

    function cancelarConsulta(id) {
        //console.log("EXCLUINDO" + id);
        $.post('/api/cancelarConsulta/' + id, function(data) {
            $('#dlgDeleteConfirm').modal('hide');
            alert(data);

        });
        carregarConsultas(loading);
    }

    function recarregaPagina() {
        document.location.reload(true);

    }

    $(function() {
        //$('#dlgLoading').modal("show");
        carregarConsultas(loading);
        setInterval(function() {
            carregarConsultas(loading);
        }, 60000);
    })
</script>

@endsection