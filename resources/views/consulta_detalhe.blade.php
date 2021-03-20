@extends('layouts.app', ["current" => "consultas"])

@section('body')

<div class="card-body">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif
  <div>

  teste teste
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
                  <div class="form-group col-md-12">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nomePaciente">
                  </div>

                  <div class="form-group col-md-5">
                    <label for="sexoPaciente">Sexo</label>
                    <select id="sexoPaciente" class="form-control">
                      <option>Feminino</option>
                      <option>Masculino</option>
                    </select>
                  </div>

                  <div class="form-group col-md-7">
                    <label for="dataNascimentoPaciente">Data Nascimento</label>
                    <input type="date" id="dataNascimentoPaciente" class="form-control">
                  </div>

                </div>
              </form>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="telefone1">Telefone</label>
              <input type="text" class="form-control" id="telefone1Paciente" placeholder="Somente nº">
            </div>

            <div class="form-group col-md-4">
              <label for="telefone2">Telefone</label>
              <input type="text" class="form-control" id="telefone2Paciente" placeholder="Somente nº">
            </div>

            <div class="form-group col-md-4">
              <label for="cep">CEP</label>
              <input type="number" class="form-control" id="cepPaciente" placeholder="Somente nº" name="cepPaciente" onblur=consultaCep($('#cepPaciente').val()) required>

              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="lograouro">Logradouro</label>
              <input type="text" class="form-control" id="logradouroPaciente">
            </div>
            <div class="form-group col-md-2">
              <label for="numero">Nº</label>
              <input type="text" class="form-control" id="numeroEnderecoPaciente">
            </div>
            <div class="form-group col-md-4">
              <label for="complemento">Complemento</label>
              <input type="text" class="form-control" id="complementoEnderecoPaciente">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-5">
              <label for="bairro">Bairro</label>
              <input type="text" class="form-control" id="bairroPaciente">
            </div>
            <div class="form-group col-md-5">
              <label for="cidade">Cidade</label>
              <input type="text" class="form-control" id="cidadePaciente">
            </div>
            <div class="form-group col-md-2">
              <label for="uf">UF</label>
              <input type="text" class="form-control" id="ufPaciente">
            </div>
          </div>

          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="emailPaciente">
          </div>

          <div class="form-group">
            <label for="relatopaciente">Motivo relatado pelo paciente</label>
            <textarea class="form-control" id="relatopaciente" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="obs">Quadro Clínico</label>
            <textarea class="form-control" id="quadroclinico" rows="3"></textarea>
          </div>

          <p>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Histórico</button>
            <button type="cancel" class="btn btn-success" data-dismiss="modal">Fechar</button>
          </p>
        </div>
      </form>
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



      $(function() {
        //$('#dlgLoading').modal("show");
        //carregarConsultas(loading);
        console.log('Javascript rodando');
      })
    </script>

    @endsection