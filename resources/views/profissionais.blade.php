@extends('layouts.app', ["current" => "profissionais"])

@section('body')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div>
        <!-- Tabela Principal apresentação -->
        <table class="table table-ordered table-hover" id="tabelaProfissionais">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Especialidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Alimentado via JQuery-->
            </tbody>
        </table>

    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onclick=novoProfissional()>Cadastrar Profissional</a>
    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgProfissionais">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formPacientes" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="model-title">Cadastro de Paciente</h5>
                </div>
                <div class="modal-body">

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
                        <input type="hidden" id="id" class="form-control">
                        <div class="form-group col-md-4">
                            <label for="cpf">CPF</label>
                            <input type="number" class="form-control" id="cpfPaciente" placeholder="Somente nº">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="rg">RG</label>
                            <input type="text" class="form-control" id="rgPaciente">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="especialidade">Especialidade</label>
                            <select id="especialidade" class="form-control">

                            </select>
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
                        <label for="obs">Obs.</label>
                        <textarea class="form-control" id="obsPaciente" rows="3"></textarea>
                    </div>

                    <p>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Prontuário</button>
                        <button type="cancel" class="btn btn-success" data-dismiss="modal">Fechar</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="dlgDeleteConfirm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="idPaciente" class="form-control">
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
                <button type="button" class="btn btn-primary" onclick=remover($('#idProfissional').val())>Sim</button>
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

    //consulta API Cep
    function consultaCep(cep) {
        if (cep.length != 8) alert("Confira o CEP")
        else {
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
                if (!("erro" in data)) {
                    $('#cidadePaciente').val(data.localidade);
                    $('#logradouroPaciente').val(data.logradouro);
                    $('#ufPaciente').val(data.uf);
                    $('#bairroPaciente').val(data.bairro);
                } else alert("CEP não encontrado, favor conferir")
            });
        }
    }

    function carregarEspecialidades() {
        $.getJSON('/api/especialidades', function(data) {
            for (i = 0; i < data.length; i++) {
                opcao = '<option value="' + data[i].id + '">' + data[i].descricao + '</option>';
                $('#especialidade').append(opcao);
            }
        });
    }


    function carregarProfissionais(callback) {
        $.getJSON('/api/profissionais', function(data) {
            for (i = 0; i < data.length; i++) {
                linha = montarLinha(data[i]);
                $('#tabelaProfissionais>tBody').append(linha)
            }
            var carga = "Carga Concluída";
            callback(carga);
        });
    }

    function montarLinha(pro) {
        var linha = "<tr>" +
            "<td>" + pro.id + "</td>" +
            "<td>" + pro.nome + "</td>" +
            "<td>" + pro.especialidade.descricao + "</td>" +
            "<td>" +
            '<button class="btn btn-sm btn-primary" style="margin: 0 5px;" onclick="editar(' + pro.id + ')">Editar</button>' +
            '<button class="btn btn-sm btn-secondary" style="margin: 0 5px;" onclick="editar(' + pro.id + ')">Prontuário</button>' +
            '<button class="btn btn-sm btn-danger" style="margin: 0 5px;" onclick="confirmaExclusao(' + pro.id + ',\'' + pro.nome + '\')">Excluir</button>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function novoProfissional() {
        $('#id').val('');
        $('#nomeProfissional').val('');
        $('#nascimentoPaciente').val('');
        $('#cpfPaciente').val('');
        $('#rgPaciente').val('');
        $('#telefone1Paciente').val('');
        $('#telefone2Paciente').val('');
        $('#cepPaciente').val('');
        $('#logradouroPaciente').val('');
        $('#numeroEnderecoPaciente').val('');
        $('#complementoEnderecoPaciente').val('');
        $('#bairroPaciente').val('');
        $('#cidadePaciente').val('');
        $('#ufPaciente').val('');
        $('#emailPaciente').val('');
        $('#obsPaciente').val('');
        $('#dlgPacientes').modal("show");
    }

    function editar(id) {
        $.getJSON('api/pacientes/' + id, function(data) {
            $('#id').val(id);
            $('#nomePaciente').val(data.nome);
            $('#sexoPaciente').val(data.sexo);
            $('#dataNascimentoPaciente').val(data.data_nascimento);
            $('#convenioPaciente').val(data.convenio_id);
            $('#cpfPaciente').val(data.cpf);
            $('#rgPaciente').val(data.rg);
            $('#telefone1Paciente').val(data.telefone1);
            $('#telefone2Paciente').val(data.telefone2);
            $('#cepPaciente').val(data.cep);
            $('#logradouroPaciente').val(data.logradouro);
            $('#numeroEnderecoPaciente').val(data.numero);
            $('#complementoEnderecoPaciente').val(data.complemento);
            $('#bairroPaciente').val(data.bairro);
            $('#cidadePaciente').val(data.cidade);
            $('#ufPaciente').val(data.uf);
            $('#emailPaciente').val(data.email);
            $('#obsPaciente').val(data.obs);
            $('#dlgPacientes').modal("show");
        });
    }

    function criarProfissional() {
        pac = {
            nome: $('#nomePaciente').val(),
            sexo: $('#sexoPaciente').val(),
            data_nascimento: $('#dataNascimentoPaciente').val(),
            convenio_id: $('#convenioPaciente').val(),
            cpf: $('#cpfPaciente').val(),
            rg: $('#rgPaciente').val(),
            telefone1: $('#telefone1Paciente').val(),
            telefone2: $('#telefone2Paciente').val(),
            cep: $('#cepPaciente').val(),
            logradouro: $('#logradouroPaciente').val(),
            numero: $('#numeroEnderecoPaciente').val(),
            complemento: $('#complementoEnderecoPaciente').val(),
            bairro: $('#bairroPaciente').val(),
            cidade: $('#cidadePaciente').val(),
            uf: $('#ufPaciente').val(),
            email: $('#emailPaciente').val(),
            obs: $('#obsPaciente').val(),
        }
        console.log(pac);
        $.post('/api/profissionais', pac, function(data) {
            console.log(data);
            paciente = JSON.parse(data);
            //linha = montarLinha(paciente);
            //$('#tabelaPacientes>tBody').append(linha);
            document.location.reload(true);
        });
    }

    function salvarProfissional() {
        pac = {
            id: $("#id").val(),
            nome: $('#nomePaciente').val(),
            sexo: $('#sexoPaciente').val(),
            data_nascimento: $('#dataNascimentoPaciente').val(),
            convenio_id: $('#convenioPaciente').val(),
            cpf: $('#cpfPaciente').val(),
            rg: $('#rgPaciente').val(),
            telefone1: $('#telefone1Paciente').val(),
            telefone2: $('#telefone2Paciente').val(),
            cep: $('#cepPaciente').val(),
            logradouro: $('#logradouroPaciente').val(),
            numero: $('#numeroEnderecoPaciente').val(),
            complemento: $('#complementoEnderecoPaciente').val(),
            bairro: $('#bairroPaciente').val(),
            cidade: $('#cidadePaciente').val(),
            uf: $('#ufPaciente').val(),
            email: $('#emailPaciente').val(),
            obs: $('#obsPaciente').val(),
        };

        console.log(pac);
        $.ajax({
            type: "PUT",
            url: "api/profissionais/" + pac.id,
            context: this,
            data: pac,
            success: function(data) {
                console.log("Profissional editado");
                document.location.reload(true);
            },
            error: function(error) {
                console.log(error);
            },
        });
    }

    $("#formPacientes").submit(function(event) {
        event.preventDefault();
        if ($("#id").val() != '')
            salvarPaciente();
        else
            criarPaciente();
        $('#formPacientes').modal('hide');
    });


    function confirmaExclusao(id, nome) {
        console.log("Confirmação exclusão do paciente " + nome);
        $('#idPaciente').val(id);
        $('#mensagemConfirmacao').text("Confirma a exclusão do(a) paciente " + nome + "?");
        $('#dlgDeleteConfirm').modal('show')
    }


    function remover(id) {
        console.log("EXCLUINDO" + id);
        $.ajax({
            type: "DELETE",
            url: "api/profissionais/" + id,
            context: this,
            success: function() {
                console.log("Profissional apagado");
                linhas = $('#tabelaProfissionais>tbody>tr');
                e = linhas.filter(function(i, elemento) {
                    return elemento.cells[0].textContent == id;
                });
                if (e)
                    $('#dlgDeleteConfirm').modal('hide');
                e.remove();
            },
            error: function(error) {
                console.log(error);
            },
        });
    }



    $(function() {
        $('#dlgLoading').modal("show");
        carregarEspecialidades();
        carregarProfissionais(loading);
    })
</script>

@endsection