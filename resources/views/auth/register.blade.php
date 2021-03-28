@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="/api/pacientes">
                        @csrf
                        {{$name ?? ''}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} Completo</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sexo" class="col-md-4 col-form-label text-md-right">Sexo</label>

                            <div class="col-md-6">
                                <select id="sexo" class="form-control" name="sexo">
                                    <option>Feminino</option>
                                    <option>Masculino</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="data_nascimento" class="col-md-4 col-form-label text-md-right">Data Nascimento</label>

                            <div class="col-md-6">
                                <input id="data_nascimento" type="date" class="form-control @error('dataNascimento') is-invalid @enderror" name="data_nascimento" value="{{ old('data_nascimento') }}" required autocomplete="data_nascimento">

                                @error('dataNascimento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>"Data de Nacimento Obrigatória"</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpf" class="col-md-4 col-form-label text-md-right">CPF</label>
                            <div class="col-md-6">
                                <input id="cpf" type="number" class="form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}" required autocomplete="cpf">
                                @error('cpf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>"CPF Inválido"</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rg" class="col-md-4 col-form-label text-md-right">RG</label>
                            <div class="col-md-6">
                                <input id="rg" type="text" class="form-control" name="rg" value="{{ old('rg') }}" autocomplete="cpf">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sexo" class="col-md-4 col-form-label text-md-right">Sexo</label>

                            <div class="col-md-6">
                                <select id="sexo" class="form-control">
                                    <option>Feminino</option>
                                    <option>Masculino</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="convenio_id" class="col-md-4 col-form-label text-md-right">Convênio</label>

                            <div class="col-md-6">
                                <select id="convenio_id" class="form-control" name="convenio_id">

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone1" class="col-md-4 col-form-label text-md-right">Telefone</label>
                            <div class="col-md-6">
                                <input id="telefone1" type="number" class="form-control @error('telefone') is-invalid @enderror" name="telefone1" value="{{ old('telefone1') }}" required autocomplete="telefone1">
                                @error('telefone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>"É necessário cadastrar ao menos um telefone"</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="telefone2" class="col-md-4 col-form-label text-md-right">Telefone 2</label>
                            <div class="col-md-6">
                                <input id="telefone2" type="number" class="form-control" name="telefone2" value="{{ old('telefone2') }}">
                            </div>
                        </div>

                        <!--Endereço -->

                        <div class="form-group row">
                            <label for="cep" class="col-md-4 col-form-label text-md-right">CEP</label>
                            <div class="col-md-6">
                                <input id="cep" type="number" class="form-control" name="cep" placeholder="Somente nº" onblur=consultaCep($('#cep').val()) required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logradouro" class="col-md-4 col-form-label text-md-right">Logradouro</label>
                            <div class="col-md-6">
                                <input id="logradouro" type="text" class="form-control" name="logradouro"required>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="numero" class="col-md-4 col-form-label text-md-right">Nº</label>
                            <div class="col-md-2">
                                <input id="numero" type="text" class="form-control" name="numero"required>
                            </div>
                            <label for="complemento">Comp.</label>
                            <div class="col-md-3">
                                <input id="complemento" type="text" class="form-control" name="complemento">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bairro" class="col-md-4 col-form-label text-md-right">Bairro</label>
                            <div class="col-md-6">
                                <input id="bairro" type="text" class="form-control" name="bairro"required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cidade" class="col-md-4 col-form-label text-md-right">Cidade</label>
                            <div class="col-md-4">
                                <input id="cidade" type="text" class="form-control" name="cidade"required>
                            </div>
                            <div class="col-md-2">
                                <input id="uf" type="text" class="form-control" placeholder="UF" name="uf"required>
                            </div>
                        </div>







                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <!--<a href="\googlelogin" class="btn btn-secondary">
                                    <img src='http://s2.glbimg.com/z_gIOSUdsxyNGClgVLYVBHBziyw=/0x0:400x400/400x400/s.glbimg.com/po/tt2/f/original/2016/05/20/new-google-favicon-logo.png' width="20px" height="20px"> Registrar com Google
                                </a>-->
                            </div>
                        </div>
                    </form>
                </div>
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
        if (cep.length != 8) alert("Confira seu CEP")
        else {
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
                if (!("erro" in data)) {
                    $('#cidade').val(data.localidade);
                    $('#logradouro').val(data.logradouro);
                    $('#uf').val(data.uf);
                    $('#bairro').val(data.bairro);
                } else alert("CEP não encontrado, favor conferir")
            });
        }
    }

    function carregarConvenios() {
        $.getJSON('/api/convenios', function(data) {
            for (i = 0; i < data.length; i++) {
                opcao = '<option value="' + data[i].id + '">' + data[i].descricao + '</option>';
                $('#convenio_id').append(opcao);
            }
        });
    }

    $(function() {
        //$('#dlgLoading').modal("show");
        carregarConvenios(loading);
        console.log('javascript ok')
    })
</script>

@endsection