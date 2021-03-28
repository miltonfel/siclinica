@extends('layouts.app', ["current" => "consultas"])

@section('body')

<div class="card-body">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif
  <div>
    <div class="modal-content">
      <form class="form-horizontal" id="formPacientes" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="model-title">Consulta</h5>
        </div>
        <div class="modal-body"> Dados Paciente

          <div class="media">
            <img src="/storage/images/no_image.png" class="align-self-center mr-3" height="150" width="150" ondblclick="teste()" id="fotoPaciente">
            <div class="media-body">
              <form class="form-horizontal">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="hidden" id="id" class="form-control">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="nomePaciente" placeholder="Digite o nome do paciente e clique em buscar">
                  </div>
                  <div class="form-group col-auto" style="margin-top:35px">
                    <a button class="btn btn-sm btn-primary" onclick="abrirBusca()">Buscar</button></a>
                  </div>
                  <div class="form-group col-md-5">
                    <label for="name">Profissional</label>
                    <select id="profissionais" class="form-control">

                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="sexoPaciente">Sexo</label>
                    <input type="text" id="sexoPaciente" class="form-control" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="dataNascimentoPaciente">Data Nascimento</label>
                    <input type="date" id="dataNascimentoPaciente" class="form-control" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="dataConsulta">Data Consulta</label>
                    <input type="date" id="dataConsulta" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="horarioConsulta">Horário Consulta</label>
                    <input type="time" id="horarioConsulta" class="form-control">
                  </div>

                </div>
              </form>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="telefone1">Telefone</label>
              <input type="text" class="form-control" id="telefone1Paciente" readonly>
            </div>

            <div class="form-group col-md-4">
              <label for="telefone2">Telefone</label>
              <input type="text" class="form-control" id="telefone2Paciente" readonly>
            </div>

            <div class="form-group col-md-4">
              <label for="cep">CEP</label>
              <input type="number" class="form-control" id="cepPaciente" name="cepPaciente" onblur=consultaCep($('#cepPaciente').val()) required readonly>

              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="lograouro">Logradouro</label>
              <input type="text" class="form-control" id="logradouroPaciente" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="numero">Nº</label>
              <input type="text" class="form-control" id="numeroEnderecoPaciente" readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="complemento">Complemento</label>
              <input type="text" class="form-control" id="complementoEnderecoPaciente" readonly>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-5">
              <label for="bairro">Bairro</label>
              <input type="text" class="form-control" id="bairroPaciente" readonly>
            </div>
            <div class="form-group col-md-5">
              <label for="cidade">Cidade</label>
              <input type="text" class="form-control" id="cidadePaciente" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="uf">UF</label>
              <input type="text" class="form-control" id="ufPaciente" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="email">E-mail</label>
              <input type="email" class="form-control" id="emailPaciente" readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="convenio">Convênio</label>
              <input type="text" id="convenioPaciente" class="form-control" readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="motivo">Motivo relatado pelo paciente</label>
            <textarea class="form-control" id="motivo" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="obs">Quadro Clínico</label>
            <textarea class="form-control" id="quadroclinico" rows="3"></textarea>
          </div>

          <p>
            <a href class="btn btn-primary" onclick='criarConsulta()'>Cadastrar</a>
            <button type="cancel" class="btn btn-success" data-dismiss="modal">Cancelar</button>
          </p>
        </div>
      </form>
    </div>

    <!-- formulário de busca de paciente -->
    <div class="modal" tabindex="-1" id="dlgbuscapaciente">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="formbuscaPaciente" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="model-title">Selecione o Paciente</h5>
            </div>
            <div class="modal-body">

              <div class="list-group" id="listaBusca">

                <lista>
                  <!-- Alimentado via JQuery-->
                </lista>

                <p>
                  <button type="cancel" class="btn btn-success" style="margin-top:15px" data-dismiss="modal" onclick='recarregaPagina()'>Cancelar</button>
                </p>
              </div>
          </form>
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

      function selecionarPaciente($id, $name) {
        $(dlgbuscapaciente).modal('hide');
        console.log('Paciente selecionado: ' + $name);

        $.getJSON('api/pacientes/' + $id, function(data) {
          $('#id').val(data[0].id);
          $('#nomePaciente').val(data[0].name);
          $('#sexoPaciente').val(data[0].sexo);
          $('#dataNascimentoPaciente').val(data[0].data_nascimento);
          $('#convenioPaciente').val(data[0].convenio.descricao);
          $('#cpfPaciente').val(data[0].cpf);
          $('#rgPaciente').val(data[0].rg);
          $('#telefone1Paciente').val(data[0].telefone1);
          $('#telefone2Paciente').val(data[0].telefone2);
          $('#cepPaciente').val(data[0].cep);
          $('#logradouroPaciente').val(data[0].logradouro);
          $('#numeroEnderecoPaciente').val(data[0].numero);
          $('#complementoEnderecoPaciente').val(data[0].complemento);
          $('#bairroPaciente').val(data[0].bairro);
          $('#cidadePaciente').val(data[0].cidade);
          $('#ufPaciente').val(data[0].uf);
          $('#emailPaciente').val(data[0].email);
          $('#obsPaciente').val(data[0].obs);
          $("#listaBusca>lista").empty();
        });
      }

      function montarLinha(pac) {
        var linha =
          '<button type="button" class="list-group-item list-group-item-action" onclick="selecionarPaciente(' + pac.id + ',\'' + pac.name + '\')">' + pac.name + '</button>';

        return linha;
      }

      function abrirBusca() {
        var nomePaciente = $('#nomePaciente').val();
        if (nomePaciente != '') {
          console.log("Buscar Paciente " + nomePaciente);
          $.getJSON('/api/buscarPacienteNome/' + nomePaciente, function(data) {
            if (data.length > 0) {
              for (i = 0; i < data.length; i++) {
                linha = montarLinha(data[i]);
                $('#listaBusca>lista').append(linha)
              }
              $(dlgbuscapaciente).modal('show');
              var carga = "Carga Concluída";
            } else {
              alert('Paciente não encontrado');
              recarregaPagina();
            }
            //callback(carga);
          });
          //$('#dlgbuscapaciente').show();
        } else(alert("Preencha o nome ou primeiro nome do paciente para buscar"));
      }

      function carregarProfissionais() {
        $.getJSON('/api/profissionais', function(data) {
          for (i = 0; i < data.length; i++) {
            opcao = '<option value="' + data[i].id + '">' + data[i].name + '</option>';
            $('#profissionais').append(opcao);
          }
        });
      }

      function criarConsulta() {
        datahoraconsulta = $('#dataConsulta').val() + ' '+ $('#horarioConsulta').val() + ':00'
        console.log(datahoraconsulta);
        if (datahoraconsulta != ' :00'){
        con = {
          agendamento: datahoraconsulta,
          convenio_id: $('#convenioPaciente').val(),
          paciente_id: $('#id').val(),
          profissional_id: $('#profissionais').val(),
          motivo: $('#motivo').val(),
        }
        console.log(con);
        $.post('/api/cadastrarConsulta', con, function(data) {
          //console.log(data);
          alert('Consulta agendada com sucesso');
          window.location.href = "/consultas";

        });
      }
      else alert ("Defina a data e o horário da consulta!");
      }


      function recarregaPagina() {
        document.location.reload(true);
      }

      $(function() {
        //$('#dlgLoading').modal("show");
        carregarProfissionais(loading);
      })
    </script>

    @endsection