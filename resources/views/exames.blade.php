@extends('layouts.app', ["current" => "exames"])

@section('body')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div>
        <!-- Tabela Principal apresentação -->
        <table class="table table-ordered table-hover" id="tabelaExames">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Alimentado via JQuery-->
            </tbody>
        </table>

    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onclick=novoExame()>Cadastrar Exame</a>
    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgExames">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formExames" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="model-title">Cadastro de Exame</h5>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="hidden" id="id" class="form-control">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="titulo" placeholder="Digite o título para buscar depois">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control" id="descricao" rows="10" placeholder="Texto do pedido de exame"></textarea>
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
                <input type="hidden" id="idExame" class="form-control">
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
                <button type="button" class="btn btn-primary" onclick=remover($('#idExame').val())>Sim</button>
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

    function carregarExames(callback) {
        $.getJSON('/api/exames', function(data) {
            for (i = 0; i < data.length; i++) {
                linha = montarLinha(data[i]);
                $('#tabelaExames>tBody').append(linha)
            }
            var carga = "Carga Concluída";
            callback(carga);
        });
    }

    function montarLinha(exa) {
        var linha = "<tr>" +
            "<td>" + exa.id + "</td>" +
            "<td>" + exa.titulo + "</td>" +
            "<td>" +
            '<button class="btn btn-sm btn-primary" style="margin: 0 5px;" onclick="editar(' + exa.id + ')">Editar</button>' +
            '<button class="btn btn-sm btn-danger" style="margin: 0 5px;" onclick="confirmaExclusao(' + exa.id + ',\'' + exa.titulo + '\')">Excluir</button>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function novoExame() {
        $('#id').val('');
        $('#titulo').val('');
        $('#descricao').val('');
        $('#dlgExames').modal("show");
    }

    function editar(id) {
        $.getJSON('api/exames/' + id, function(data) {
            $('#id').val(id);
            $('#titulo').val(data.titulo);
            $('#descricao').val(data.descricao);
            $('#dlgExames').modal("show");
        });
    }

    function criarExame() {
        exa = {
            titulo: $('#titulo').val(),
            descricao: $('#descricao').val(),
        }
        console.log(exa);
        $.post('/api/exames', exa, function(data) {
            console.log(data);
            document.location.reload(true);
        });
    }

    function salvarExame() {
        exa = {
            id: $("#id").val(),
            titulo: $("#titulo").val(),
            descricao: $('#descricao').val(),
        };

        console.log(exa);
        $.ajax({
            type: "PUT",
            url: "api/exames/" + exa.id,
            context: this,
            data: exa,
            success: function(data) {
                console.log("Exame editado");
                document.location.reload(true);
            },
            error: function(error) {
                console.log(error);
            },
        });
    }

    $("#formExames").submit(function(event) {
        event.preventDefault();
        if ($("#id").val() != '')
            salvarExame();
            //console.log("Entrara em edição");
        else
            criarExame();
        $('#formExames').modal('hide');
    });


    function confirmaExclusao(id, titulo) {
        console.log("Confirmação exclusão do exame " + titulo);
        $('#idExame').val(id);
        $('#mensagemConfirmacao').text("Confirma a exclusão do exame " + titulo + "?");
        $('#dlgDeleteConfirm').modal('show')
    }


    function remover(id) {
        console.log("EXCLUINDO" + id);
        $.ajax({
            type: "DELETE",
            url: "api/exames/" + id,
            context: this,
            success: function() {
                console.log("Exame apagado");
                linhas = $('#tabelaExames>tbody>tr');
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
        carregarExames(loading);
    })
</script>

@endsection