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
            <thead>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="dataBusca">Data</label>
                    <input type="date" id="dataBusca" class="form-control" value={{date('y-M-d')}} onchange="carregarConsultas(loading)">
                </div>
                <div class="form-group col-md-5">
                    <label for="nome">Profissional</label>
                    <select id="profissionais" class="form-control" onchange="carregarConsultas(loading)">

                    </select>
                  </div>
            </div>
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
        <a button class="btn btn-sm btn-primary" role="button" href="/consulta_detalhe">Nova Consulta</a>
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
        dataConsultas = $('#dataBusca').val();
        //console.log(dataConsultas);
        $.getJSON('/api/consultaPorData/'+dataConsultas+'/'+ $('#profissionais').val(), function(data) {
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
            "<td>" + con.id + "</td>" +
            "<td>" + con.paciente.nome + "</td>" +
            "<td>" + data + " - " + horario + "</td>" +
            "<td>" + con.status + "</td>" +
            "<td>" +
            '<button class="btn btn-sm btn-primary" style="margin: 0 5px;" onclick="editar(' + con.id + ')">Editar</button>' +
            '<button class="btn btn-sm btn-secondary" style="margin: 0 5px;" onclick="editar(' + con.id + ')">Prontuário</button>' +
            '<button class="btn btn-sm btn-danger" style="margin: 0 5px;" onclick="confirmaExclusao(' + con.id + ',\'' + con.nome + '\')">Excluir</button>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function carregarProfissionais() {
        $.getJSON('/api/profissionais', function(data) {
          for (i = 0; i < data.length; i++) {
            opcao = '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
            $('#profissionais').append(opcao);
          }
        });
      }

    $(function() {
        //$('#dlgLoading').modal("show");
        //carregarConsultas(loading);
        carregarProfissionais(loading);
    })
</script>

@endsection