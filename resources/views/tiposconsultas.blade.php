@extends('layouts.app', ["current" => "tipos"])

@section('body')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div>
    <h4>Tipos de Consultas</h4>
        <!-- Tabela Principal apresentação -->
        <table class="table table-ordered table-hover" id="tabelaTipos">
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
        <button class="btn btn-sm btn-primary" role="button" onclick=novoTipo()>Cadastrar Tipo de Consulta</a>
    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgTipos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formTipos" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="model-title">Cadastro de Tipo de Consulta</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id" class="form-control">
                        <input type="text" placeholder="Descrição Tipo Consulta" id="descricao">
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
                <input type="hidden" id="idTipo" class="form-control">
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

    function carregarTipos(callback) {
        $.getJSON('/api/tipos', function(data) {
            for (i = 0; i < data.length; i++) {
                linha = montarLinha(data[i]);
                $('#tabelaTipos>tBody').append(linha)
            }
            var carga = "Carga Concluída";
            callback(carga);
        });
    }

    function montarLinha(tip) {
        var linha = "<tr>" +
            "<td>" + tip.id + "</td>" +
            "<td>" + tip.descricao + "</td>" +
            "<td>" +
            '<button class="btn btn-sm btn-primary" style="margin: 0 5px;" onclick="editar(' + tip.id + ')">Editar</button>' +
            '<button class="btn btn-sm btn-danger" style="margin: 0 5px;" onclick="confirmaExclusao(' + tip.id + ',\'' + tip.descricao + '\')">Excluir</button>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function novoTipo() {
        $('#id').val('');
        $('#descricao').val('');
        $('#dlgTipos').modal("show");
    }

    function editar(id) {
        $.getJSON('api/tipos/' + id, function(data) {
            $('#id').val(id);
            $('#descricao').val(data.descricao);
            $('#dlgTipos').modal("show");
        });
    }

    function criarTipo() {
        tip = {
            descricao: $('#descricao').val(),
        }
        console.log(tip);
        $.post('/api/tipos', tip, function(data) {
            console.log(data);
            //linha = montarLinha(especialidade);
            //$('#tabelaConvenios>tBody').append(linha);
            document.location.reload(true);
        });
    }

    function salvarTipo() {
        tip = {
            id: $("#id").val(),
            descricao: $('#descricao').val(),
        };

        console.log(tip);
        $.ajax({
            type: "PUT",
            url: "api/tipos/" + tip.id,
            context: this,
            data: tip,
            success: function(data) {
                console.log("Tipo editado");
                document.location.reload(true);
            },
            error: function(error) {
                console.log(error);
            },
        });
    }

    $("#formTipos").submit(function(event) {
        event.preventDefault();
        if ($("#id").val() != '')
            salvarTipo();
        else
            criarTipo();
        $('#formTipos').modal('hide');
    });


    function confirmaExclusao(id, descricao) {
        console.log("Confirmação exclusão do Tipo " + descricao);
        $('#idEspecialidade').val(id);
        $('#mensagemConfirmacao').text("Confirma a exclusão do Tipo " + descricao + "?");
        $('#dlgDeleteConfirm').modal('show')
    }


    function remover(id) {
        console.log("EXCLUINDO" + id);
        $.ajax({
            type: "DELETE",
            url: "api/tipos/" + id,
            context: this,
            success: function() {
                console.log("Tipo de consulta apagado");
                linhas = $('#tabelaTipos>tbody>tr');
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
        carregarTipos(loading);
    })
</script>

@endsection