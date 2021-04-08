@extends('layouts.app', ["current" => "agenda"])

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
        </div>
        <div class="modal-body">
          <div class="media">
            <!--<img src="/storage/images/no_image.png" class="align-self-center mr-3" height="150" width="150" ondblclick="teste()" id="fotoPaciente">-->
            <div class="media-body">
              <form class="form-horizontal">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="hidden" id="id" value={{$id}} class="form-control">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nomePaciente" readonly>
                  </div>
                  <div class="form-group col-md-5">
                    <label for="nome">Profissional</label>
                    <input type="text" id="profissionais" class="form-control" readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <label for="sexoPaciente">Sexo</label>
                    <input type="text" id="sexoPaciente" class="form-control" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="dataNascimentoPaciente">Data Nascimento</label>
                    <input type="date" id="dataNascimentoPaciente" class="form-control" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="dataConsulta">Data Consulta</label>
                    <input type="date" id="dataConsulta" class="form-control" readonly>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="horarioConsulta">Horário Consulta</label>
                    <input type="time" id="horarioConsulta" class="form-control" readonly>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="horarioConsulta">Tipo</label>
                    <input type="text" id="tipoConsulta" class="form-control" readonly>
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
            <textarea class="form-control" id="diagnostico" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="obs">Receita</label>
            <textarea class="form-control" placeholder="Busque uma receita pre cadastrada ou digite" id="receita" rows="4"></textarea>
            <a class="btn btn-primary" onclick='carregarReceituarios()'>Buscar Receita</a>
            <a class="btn btn-warning" onclick=''>Imprimir Receita</a>
          </div>

          <div class="form-group">
            <label for="obs">Pedido de exame</label>
            <textarea class="form-control" placeholder="Busque um exame pre cadastrado ou digite" id="exame" rows="4"></textarea>
            <a class="btn btn-primary" onclick='carregarExames()'>Buscar Exame</a>
            <a class="btn btn-warning" onclick=''>Imprimir Pedido</a>
          </div>


          <p>
            <a href class="btn btn-success" onclick='finalizarConsulta({{$id}})'>FinalizarConsulta</a>
            <a href class="btn btn-info" onclick='finalizarConsulta({{$id}})'>Gerar Atestado</a>
            <a href='\consultas' class="btn btn-danger">Sair</a>
          </p>
        </div>
      </form>
    </div>
    

    <!-- formulário de busca de receita -->
    <div class="modal" tabindex="-1" id="dlgbuscareceita">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="formbuscareceita" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="model-title">Selecione a receita</h5>
            </div>
            <div class="modal-body">

              <div class="list-group" id="listaBuscaReceita">

                <lista>
                  <!-- Alimentado via JQuery-->
                </lista>

                <p>
                  <button type="cancel" class="btn btn-success" style="margin-top:15px" data-dismiss="modal">Cancelar</button>
                </p>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    <!-- formulário de busca de exame -->
    <div class="modal" tabindex="-1" id="dlgbuscaexames">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="formbuscaexames" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="model-title">Selecione o pedido de exame</h5>
            </div>
            <div class="modal-body">

              <div class="list-group" id="listaBuscaExames">

                <lista>
                  <!-- Alimentado via JQuery-->
                </lista>

                <p>
                  <button type="cancel" class="btn btn-success" style="margin-top:15px" data-dismiss="modal">Cancelar</button>
                </p>
              </div>
          </form>
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

      function abrirConsulta($id) {
        $.getJSON('../api/abrirConsulta/' + $id, function(data) {
          $('#id').val(data[0].id);
          $('#profissionais').val(data[0].profissional.name);
          $('#dataConsulta').val((data[0].agendamento).slice(0, 10));
          $('#horarioConsulta').val((data[0].agendamento).slice(11, 16));
          $('#tipoConsulta').val(data[0].tipo_id);
          $('#nomePaciente').val(data[0].paciente.name);
          $('#sexoPaciente').val(data[0].paciente.sexo);
          $('#dataNascimentoPaciente').val(data[0].paciente.data_nascimento);
          $('#convenioPaciente').val(data[0].convenio.descricao);
          $('#telefone1Paciente').val(data[0].paciente.telefone1);
          $('#telefone2Paciente').val(data[0].paciente.telefone2);
          $('#cepPaciente').val(data[0].paciente.cep);
          $('#logradouroPaciente').val(data[0].paciente.logradouro);
          $('#numeroEnderecoPaciente').val(data[0].paciente.numero);
          $('#complementoEnderecoPaciente').val(data[0].paciente.complemento);
          $('#bairroPaciente').val(data[0].paciente.bairro);
          $('#cidadePaciente').val(data[0].paciente.cidade);
          $('#ufPaciente').val(data[0].paciente.uf);
          $('#emailPaciente').val(data[0].paciente.email);
          $('#motivo').val(data[0].motivo);
          $('#diagnostico').val(data[0].diagnostico);
          $('#receita').val(data[0].receita);
          $('#exame').val(data[0].exame);
        });
      }

      function finalizarConsulta($id) {
        event.preventDefault();
        con = {
          id: $id,
          motivo: $('#motivo').val(),
          diagnostico: $('#diagnostico').val(),
          receita: $('#receita').val(),
          exame: $('#exame').val(),
        };
        console.log(con);
        $.ajax({
          type: "PUT",
          url: "../api/consultas/" + con.id,
          context: this,
          data: con,
          success: function(data) {
            alert('Consulta finalizada');
            window.location.href = "/consultas";
            //document.location.reload(true);
          },
          error: function(error) {
            console.log(error);
          },
        });
      }

      function montarLinha(rec) {
        var linha =
          '<button type="button" class="list-group-item list-group-item-action" onclick="preencherReceita(' + rec.id + ' )">' + rec.titulo + '</button>';
        return linha;
      }

      function carregarReceituarios() {
        $("#listaBuscaReceita>lista").empty();
        $.getJSON('../api/receituarios', function(data) {
          if (data.length > 0) {
            for (i = 0; i < data.length; i++) {
              linha = montarLinha(data[i]);
              $('#listaBuscaReceita>lista').append(linha)
            }
            $('#dlgbuscareceita').modal('show');
            var carga = "Carga Concluída";
          } else {
            alert('Não existem receitas pré cadastradas');
          }
        });
      }

      function preencherReceita(id, ) {
        //console.log(id);
        $.getJSON('../api/receituarios/' + id, function(data) {
          $('#receita').val(data.descricao);
        });
        $('#dlgbuscareceita').modal('hide');
      }


      function montarLinhaExame(exa) {
        var linha =
          '<button type="button" class="list-group-item list-group-item-action" onclick="preencherExame(' + exa.id + ' )">' + exa.titulo + '</button>';
        return linha;
      }

      function carregarExames() {
        console.log("Busca de exames");
        $("#listaBuscaExames>lista").empty();
        $.getJSON('../api/exames', function(data) {
          if (data.length > 0) {
            for (i = 0; i < data.length; i++) {
              linha = montarLinhaExame(data[i]);
              $('#listaBuscaExames>lista').append(linha)
            }
            $('#dlgbuscaexames').modal('show');
            var carga = "Carga Concluída";
          } else {
            alert('Não existem pedidos de exames pré cadastrados');
          }
        });
      }

      function preencherExame(id, ) {
        //console.log(id);
        $.getJSON('../api/exames/' + id, function(data) {
          $('#exame').val(data.descricao);
        });
        $('#dlgbuscaexames').modal('hide');
      }

      function recarregaPagina() {
        document.location.reload(true);
      }


      $(function() {
        //console.log($('#id').val());
        abrirConsulta($('#id').val());
      })
    </script>

    @endsection