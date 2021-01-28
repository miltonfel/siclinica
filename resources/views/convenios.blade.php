@extends('layouts.app', ["current" => "convenios"])

@section('body')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div>
        <!-- Tabela Principal apresentação -->
        <table class="table table-ordered table-hover" id="tabelaConvenios">
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
        <button class="btn btn-sm btn-primary" role="button" onclick=novoConvenio()>Cadastrar Convênio</a>
    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgConvenios">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formConvenios" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="model-title">Cadastro de Convênio</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id" class="form-control">
                        <input type="text" placeholder="Descrição Convênio" id="descricao">
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
                <input type="hidden" id="idConvenio" class="form-control">
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
                <button type="button" class="btn btn-primary" onclick=remover($('#idConvenio').val())>Sim</button>
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

    function carregarConvenios(callback) {
        $.getJSON('/api/convenios', function(data) {
            for (i = 0; i < data.length; i++) {
                linha = montarLinha(data[i]);
                $('#tabelaConvenios>tBody').append(linha)
            }
            var carga = "Carga Concluída";
            callback(carga);
        });
    }

    function montarLinha(con) {
        var linha = "<tr>" +
            "<td>" + con.id + "</td>" +
            "<td>" + con.descricao + "</td>" +
            "<td>" +
            '<button class="btn btn-sm btn-primary" style="margin: 0 5px;" onclick="editar(' + con.id + ')">Editar</button>' +
            '<button class="btn btn-sm btn-danger" style="margin: 0 5px;" onclick="confirmaExclusao(' + con.id + ',\'' + con.descricao + '\')">Excluir</button>' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function novoConvenio() {
        $('#id').val('');
        $('#descricao').val('');
        $('#dlgConvenios').modal("show");
    }

    function editar(id) {
        $.getJSON('api/convenios/' + id, function(data) {
            $('#id').val(id);
            $('#descricao').val(data.descricao);
            $('#dlgConvenios').modal("show");
        });
    }

    function criarConvenio() {
        con = {
            descricao: $('#descricao').val(),
        }
        console.log(con);
        $.post('/api/convenios', con, function(data) {
            console.log(data);
            convenio = JSON.parse(data);
            //linha = montarLinha(convenio);
            //$('#tabelaConvenios>tBody').append(linha);
            document.location.reload(true);
        });
    }

    function salvarConvenio() {
        con = {
            id: $("#id").val(),
            descricao: $('#descricao').val(),
        };

        console.log(con);
        $.ajax({
            type: "PUT",
            url: "api/convenios/" + con.id,
            context: this,
            data: con,
            success: function(data) {
                console.log("Convênio editado");
                document.location.reload(true);
            },
            error: function(error) {
                console.log(error);
            },
        });
    }

    $("#formConvenios").submit(function(event) {
        event.preventDefault();
        if ($("#id").val() != '')
            salvarConvenio();
        else
            criarConvenio();
        $('#formConvenios').modal('hide');
    });


    function confirmaExclusao(id, descricao) {
        console.log("Confirmação exclusão do convênio " + descricao);
        $('#idConvenio').val(id);
        $('#mensagemConfirmacao').text("Confirma a exclusão do convênio " + descricao + "?");
        $('#dlgDeleteConfirm').modal('show')
    }


    function remover(id) {
        console.log("EXCLUINDO" + id);
        $.ajax({
            type: "DELETE",
            url: "api/convenios/" + id,
            context: this,
            success: function() {
                console.log("Convênio apagado");
                linhas = $('#tabelaConvenios>tbody>tr');
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
        carregarConvenios(loading);
    })
</script>

@endsection