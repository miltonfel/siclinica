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
            <form class="form-horizontal" id="formProfissionais" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="model-title">Cadastro de Profissional</h5>
                </div>
                <div class="modal-body">

                    <div class="media">
                        <!--<img src="/storage/images/no_image.png" class="align-self-center mr-3" height="150" width="150" ondblclick="teste()" id="fotoProfissional">-->
                        <div class="media-body">
                            <form class="form-horizontal">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control" id="nomeProfissional">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="sexoProfissional">Sexo</label>
                                        <select id="sexoProfissional" class="form-control">
                                            <option>Feminino</option>
                                            <option>Masculino</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-7">
                                        <label for="dataNascimentoProfissional">Data Nascimento</label>
                                        <input type="date" id="dataNascimentoProfissional" class="form-control">
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="form-row">
                        <input type="hidden" id="id" class="form-control">
                        <div class="form-group col-md-4">
                            <label for="cpf">CPF</label>
                            <input type="number" class="form-control" id="cpfProfissional" placeholder="Somente nº">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="rg">RG</label>
                            <input type="text" class="form-control" id="rgProfissional">
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
                            <input type="text" class="form-control" id="telefone1Profissional" placeholder="Somente nº">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="telefone2">Telefone</label>
                            <input type="text" class="form-control" id="telefone2Profissional" placeholder="Somente nº">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="cep">CEP</label>
                            <input type="number" class="form-control" id="cepProfissional" placeholder="Somente nº" name="cepProfissional" onblur=consultaCep($('#cepProfissional').val()) required>

                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lograouro">Logradouro</label>
                            <input type="text" class="form-control" id="logradouroProfissional">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="numero">Nº</label>
                            <input type="text" class="form-control" id="numeroEnderecoProfissional">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="form-control" id="complementoEnderecoProfissional">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" id="bairroProfissional">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" id="cidadeProfissional">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="uf">UF</label>
                            <input type="text" class="form-control" id="ufProfissional">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="emailProfissional">
                    </div>

                    <div class="form-group">
                        <label for="obs">Obs.</label>
                        <textarea class="form-control" id="obsProfissional" rows="3"></textarea>
                    </div>

                    <p>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <!--<button type="cancel" class="btn btn-secondary" data-dismiss="modal">Agenda</button>-->
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
                <input type="hidden" id="idProfissional" class="form-control">
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
                    $('#cidadeProfissional').val(data.localidade);
                    $('#logradouroProfissional').val(data.logradouro);
                    $('#ufProfissional').val(data.uf);
                    $('#bairroProfissional').val(data.bairro);
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
            "<td>" + pro.name + "</td>" +
            "<td>" + pro.especialidade.descricao + "</td>" +
            "<td>" +
            '<button class="btn btn-sm btn-primary" style="margin: 0 5px;" onclick="editar(' + pro.id + ')">Editar</button>' +
            '<!--<button class="btn btn-sm btn-secondary" style="margin: 0 5px;" onclick="editar(' + pro.id + ')">Agenda</button>-->' +
            '<button class="btn btn-sm btn-danger" style="margin: 0 5px;" onclick="confirmaExclusao(' + pro.id + ',\'' + pro.name + '\')">Excluir</button>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function novoProfissional() {
        $('#id').val('');
        $('#nomeProfissional').val('');
        $('#dataNascimentoProfissional').val('');
        $('#cpfProfissional').val('');
        $('#rgProfissional').val('');
        $('#telefone1Profissional').val('');
        $('#telefone2Profissional').val('');
        $('#cepProfissional').val('');
        $('#logradouroProfissional').val('');
        $('#numeroEnderecoProfissional').val('');
        $('#complementoEnderecoProfissional').val('');
        $('#bairroProfissional').val('');
        $('#cidadeProfissional').val('');
        $('#ufProfissional').val('');
        $('#emailProfissional').val('');
        $('#obsProfissional').val('');
        $('#dlgProfissionais').modal("show");
    }

    function editar(id) {
        $.getJSON('api/profissionais/' + id, function(data) {
            $('#id').val(id);
            $('#nomeProfissional').val(data.name);
            $('#sexoProfissional').val(data.sexo);
            $('#dataNascimentoProfissional').val(data.data_nascimento);
            $('#especialidade').val(data.especialidade_id);
            $('#cpfProfissional').val(data.cpf);
            $('#rgProfissional').val(data.rg);
            $('#telefone1Profissional').val(data.telefone1);
            $('#telefone2Profissional').val(data.telefone2);
            $('#cepProfissional').val(data.cep);
            $('#logradouroProfissional').val(data.logradouro);
            $('#numeroEnderecoProfissional').val(data.numero);
            $('#complementoEnderecoProfissional').val(data.complemento);
            $('#bairroProfissional').val(data.bairro);
            $('#cidadeProfissional').val(data.cidade);
            $('#ufProfissional').val(data.uf);
            $('#emailProfissional').val(data.email);
            $('#obsProfissional').val(data.obs);
            $('#dlgProfissionais').modal("show");
        });
    }

    function criarProfissional() {
        pac = {
            name: $('#nomeProfissional').val(),
            sexo: $('#sexoProfissional').val(),
            data_nascimento: $('#dataNascimentoProfissional').val(),
            especialidade_id: $('#especialidade').val(),
            cpf: $('#cpfProfissional').val(),
            rg: $('#rgProfissional').val(),
            telefone1: $('#telefone1Profissional').val(),
            telefone2: $('#telefone2Profissional').val(),
            cep: $('#cepProfissional').val(),
            logradouro: $('#logradouroProfissional').val(),
            numero: $('#numeroEnderecoProfissional').val(),
            complemento: $('#complementoEnderecoProfissional').val(),
            bairro: $('#bairroProfissional').val(),
            cidade: $('#cidadeProfissional').val(),
            uf: $('#ufProfissional').val(),
            email: $('#emailProfissional').val(),
            obs: $('#obsProfissional').val(),
        }
        console.log(pac);
        $.post('/api/profissionais', pac, function(data) {
            console.log(data);
            Profissional = JSON.parse(data);
            //linha = montarLinha(Profissional);
            //$('#tabelaProfissionals>tBody').append(linha);
            document.location.reload(true);
        });
    }

    function salvarProfissional() {
        pro = {
            id: $("#id").val(),
            name: $('#nomeProfissional').val(),
            sexo: $('#sexoProfissional').val(),
            data_nascimento: $('#dataNascimentoProfissional').val(),
            especialidade_id: $('#especialidade').val(),
            cpf: $('#cpfProfissional').val(),
            rg: $('#rgProfissional').val(),
            telefone1: $('#telefone1Profissional').val(),
            telefone2: $('#telefone2Profissional').val(),
            cep: $('#cepProfissional').val(),
            logradouro: $('#logradouroProfissional').val(),
            numero: $('#numeroEnderecoProfissional').val(),
            complemento: $('#complementoEnderecoProfissional').val(),
            bairro: $('#bairroProfissional').val(),
            cidade: $('#cidadeProfissional').val(),
            uf: $('#ufProfissional').val(),
            email: $('#emailProfissional').val(),
            obs: $('#obsProfissional').val(),
        };

        console.log(pro);
        $.ajax({
            type: "PUT",
            url: "api/profissionais/" + pro.id,
            context: this,
            data: pro,
            success: function(data) {
                console.log("Profissional editado");
                //console.log(JSON.parse(data));
                document.location.reload(true);
            },
            error: function(error) {
                console.log(error);
            },
        });
    }

    $("#formProfissionais").submit(function(event) {
        event.preventDefault();
        if ($("#id").val() != '')
            salvarProfissional();
        else
            criarProfissional();
        $('#formProfissionais').modal('hide');
    });


    function confirmaExclusao(id, name) {
        console.log("Confirmação exclusão do Profissional " + name);
        $('#idProfissional').val(id);
        $('#mensagemConfirmacao').text("Confirma a exclusão do(a) Profissional " + name + "?");
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