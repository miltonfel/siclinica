<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfissionaisController extends Controller
{
    public function index()
    {
        $profs = User::with(['especialidade'])->where('tipo', '=', 'profissional')->get();
        return $profs->toJson();
    }

    public function store(Request $request)
    {
        $pro = new User();
        $pro->name = $request->input('name');
        $pro->sexo = $request->input('sexo');
        $pro->data_nascimento = $request->input('data_nascimento');
        $pro->especialidade_id = $request->input('especialidade_id');
        $pro->cpf = $request->input('cpf');
        $pro->password = 'semacesso';
        $pro->rg = $request->input('rg');
        $pro->telefone1 = $request->input('telefone1');
        $pro->telefone2 = $request->input('telefone2');
        $pro->cep = $request->input('cep');
        $pro->logradouro = $request->input('logradouro');
        $pro->numero = $request->input('numero');
        $pro->complemento = $request->input('complemento');
        $pro->bairro = $request->input('bairro');
        $pro->cidade = $request->input('cidade');
        $pro->uf = $request->input('uf');
        $pro->email = $request->input('email');
        $pro->obs = $request->input('obs');
        $pro->tipo = 'profissional';
        $pro->save();
        return json_encode($pro);
    }


    public function update(Request $request, $id)
    {
        $pro = User::find($id);
        if (isset($pro)) {
            $pro->name = $request->input('name');
            $pro->sexo = $request->input('sexo');
            $pro->data_nascimento = $request->input('data_nascimento');
            $pro->especialidade_id = $request->input('especialidade_id');
            $pro->cpf = $request->input('cpf');
            $pro->rg = $request->input('rg');
            $pro->telefone1 = $request->input('telefone1');
            $pro->telefone2 = $request->input('telefone2');
            $pro->cep = $request->input('cep');
            $pro->logradouro = $request->input('logradouro');
            $pro->numero = $request->input('numero');
            $pro->complemento = $request->input('complemento');
            $pro->bairro = $request->input('bairro');
            $pro->cidade = $request->input('cidade');
            $pro->uf = $request->input('uf');
            $pro->email = $request->input('email');
            $pro->obs = $request->input('obs');
            $pro->save();
            return json_encode($pro);
        }
        return response('Profissional não encontrado(a)', 404);
    }

    public function show($id)
    {
        $pro = User::find($id);
        if (isset($pro)) {
            return json_encode($pro);
        }
        return response('Profissional não encontrado(a)', 404);
    }

    public function destroy($id)
    {
        $pro = User::find($id);
        if (isset($pro)) {
            $pro->delete();
            return response('OK', 200);
        }
        return response('Profissional não encontrado', 404);
    }

    public function listarUsuarios()
    {
        $users = DB::table('users')->orderBy('name')->get();
        return $users->toJson();
    }

    public function alterarTipoUsuario($id, $tipo)
    {
        $user = User::find($id);
        if (isset($user)) {
            $user->tipo = $tipo;
            $user->save();
        } else return ('Cadastro não encontrado');
    }
}
