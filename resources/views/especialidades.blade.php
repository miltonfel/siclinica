@extends('layouts.app', ["current" => "especialidades"])

@section('body')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div>
        <!-- Tabela Principal apresentação -->
        <table class="table table-ordered table-hover" id="tabelaEspecialidades">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Alimentado via JQuery-->
            </tbody>
        </table>

    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onclick=novaEspecialidade()>Cadastrar Especialidade</a>
    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgEspecialidades">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formEspecialidades" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="model-title">Cadastro de Especialidade</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id" class="form-control">
                        <input type="text" placeholder="Descrição Especialidade" id="descricao">
                   </div>
                    <p>
                        <button type="submit" class="btn btn-primary">Salvar</button>
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
                <input type="hidden" id="idEspecialidade" class="form-control">
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
                <button type="button" class="btn btn-primary" onclick=remover($('#idEspecialidade').val())>Sim</button>
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

    function carregarEspecialidades(callback) {
        $.getJSON('/api/especialidades', function(data) {
            for (i = 0; i < data.length; i++) {
                linha = montarLinha(data[i]);
                $('#tabelaEspecialidades>tBody').append(linha)
            }
            var carga = "Carga Concluída";
            callback(carga);
        });
    }

    function montarLinha(esp) {
        var linha = "<tr>" +
            "<td>" + esp.id + "</td>" +
            "<td>" + esp.descricao + "</td>" +
            "<td>" +
            '<button class="btn btn-sm btn-primary" style="margin: 0 5px;" onclick="editar(' + esp.id + ')">Editar</button>' +
            '<button class="btn btn-sm btn-danger" style="margin: 0 5px;" onclick="confirmaExclusao(' + esp.id + ',\'' + esp.descricao + '\')">Excluir</button>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function novaEspecialidade() {
        $('#id').val('');
        $('#descricao').val('');
        $('#dlgEspecialidades').modal("show");
    }

    function editar(id) {
        $.getJSON('api/especialidades/' + id, function(data) {
            $('#id').val(id);
            $('#descricao').val(data.descricao);
            $('#dlgEspecialidades').modal("show");
        });
    }

    function criarEspecialidade() {
        esp = {
            descricao: $('#descricao').val(),
        }
        console.log(esp);
        $.post('/api/especialidades', esp, function(data) {
            console.log(data);
            especialidade = JSON.parse(data);
            //linha = montarLinha(especialidade);
            //$('#tabelaConvenios>tBody').append(linha);
            document.location.reload(true);
        });
    }

    function salvarEspecialidade() {
        esp = {
            id: $("#id").val(),
            descricao: $('#descricao').val(),
        };

        console.log(esp);
        $.ajax({
            type: "PUT",
            url: "api/especialidades/" + esp.id,
            context: this,
            data: esp,
            success: function(data) {
                console.log("Especialidade editada");
                document.location.reload(true);
            },
            error: function(error) {
                console.log(error);
            },
        });
    }

    $("#formEspecialidades").submit(function(event) {
        event.preventDefault();
        if ($("#id").val() != '')
            salvarEspecialidade();
        else
            criarEspecialidade();
        $('#formEspecialidades').modal('hide');
    });


    function confirmaExclusao(id, descricao) {
        console.log("Confirmação exclusão da Especialidade " + descricao);
        $('#idEspecialidade').val(id);
        $('#mensagemConfirmacao').text("Confirma a exclusão do Especialidade " + descricao + "?");
        $('#dlgDeleteConfirm').modal('show')
    }


    function remover(id) {
        console.log("EXCLUINDO" + id);
        $.ajax({
            type: "DELETE",
            url: "api/especialidades/" + id,
            context: this,
            success: function() {
                console.log("Especialidade apagada");
                linhas = $('#tabelaEspecialidades>tbody>tr');
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
        carregarEspecialidades(loading);
    })
</script>

@endsection