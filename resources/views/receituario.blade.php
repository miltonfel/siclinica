@extends('layouts.app', ["current" => "receituario"])

@section('body')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div>
        <!-- Tabela Principal apresentação -->
        <table class="table table-ordered table-hover" id="tabelaReceituario">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sintoma</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Alimentado via JQuery-->
            </tbody>
        </table>

    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onclick=novaReceita()>Cadastrar Receita</a>
    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgReceitas">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formReceituario" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="model-title">Cadastro de Receita</h5>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="hidden" id="id" class="form-control">
                            <label for="titulo">Sintoma</label>
                            <input type="text" class="form-control" id="titulo" placeholder="Digite o sintoma para buscar depois">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control" id="descricao" rows="10" placeholder="Texto da receita"></textarea>
                        </div>

                        <p>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="cancel" class="btn btn-success" data-dismiss="modal">Fechar</button>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgDeleteConfirm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="idReceita" class="form-control">
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
                <button type="button" class="btn btn-primary" onclick=remover($('#idReceita').val())>Sim</button>
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

    function carregarReceituarios(callback) {
        $.getJSON('/api/receituarios', function(data) {
            for (i = 0; i < data.length; i++) {
                linha = montarLinha(data[i]);
                $('#tabelaReceituario>tBody').append(linha)
            }
            var carga = "Carga Concluída";
            callback(carga);
        });
    }

    function montarLinha(rec) {
        var linha = "<tr>" +
            "<td>" + rec.id + "</td>" +
            "<td>" + rec.titulo + "</td>" +
            "<td>" +
            '<button class="btn btn-sm btn-primary" style="margin: 0 5px;" onclick="editar(' + rec.id + ')">Editar</button>' +
            '<button class="btn btn-sm btn-danger" style="margin: 0 5px;" onclick="confirmaExclusao(' + rec.id + ',\'' + rec.titulo + '\')">Excluir</button>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function novaReceita() {
        $('#id').val('');
        $('#titulo').val('');
        $('#descricao').val('');
        $('#dlgReceitas').modal("show");
    }

    function editar(id) {
        $.getJSON('api/receituarios/' + id, function(data) {
            $('#id').val(id);
            $('#titulo').val(data.titulo);
            $('#descricao').val(data.descricao);
            $('#dlgReceitas').modal("show");
        });
    }

    function criarReceita() {
        rec = {
            titulo: $('#titulo').val(),
            descricao: $('#descricao').val(),
        }
        console.log(rec);
        $.post('/api/receituarios', rec, function(data) {
            console.log(data);
            document.location.reload(true);
        });
    }

    function salvarReceita() {
        rec = {
            id: $("#id").val(),
            titulo: $("#titulo").val(),
            descricao: $('#descricao').val(),
        };

        console.log(rec);
        $.ajax({
            type: "PUT",
            url: "api/receituarios/" + rec.id,
            context: this,
            data: rec,
            success: function(data) {
                console.log("Receita editada");
                document.location.reload(true);
            },
            error: function(error) {
                console.log(error);
            },
        });
    }

    $("#formReceituario").submit(function(event) {
        event.preventDefault();
        if ($("#id").val() != '')
            salvarReceita();
            //console.log("Entrara em edição");
        else
            criarReceita();
        $('#formReceituario').modal('hide');
    });


    function confirmaExclusao(id, titulo) {
        console.log("Confirmação exclusão da receita " + titulo);
        $('#idReceita').val(id);
        $('#mensagemConfirmacao').text("Confirma a exclusão da receita " + titulo + "?");
        $('#dlgDeleteConfirm').modal('show')
    }


    function remover(id) {
        console.log("EXCLUINDO" + id);
        $.ajax({
            type: "DELETE",
            url: "api/receituarios/" + id,
            context: this,
            success: function() {
                console.log("Receita apagada");
                linhas = $('#tabelaReceituario>tbody>tr');
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
        carregarReceituarios(loading);
    })
</script>

@endsection