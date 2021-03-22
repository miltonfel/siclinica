<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profissional;

class ProfissionaisController extends Controller
{
    public function index()
    {
        $profs = Profissional::with(['especialidade'])->get();
        return $profs->toJson();
    }

    public function store(Request $request)
    {
        $pro = new Profissional();
        $pro->nome = $request->input('nome');
        $pro->sexo = $request->input('sexo');
        $pro->data_nascimento = $request->input('data_nascimento');
        $pro->especialidade_id = $request->input('especialidade_id');
        $pro->cpf = $request->input('cpf');
        $pro->password = $request->input('cpf');
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
        $pro->ativo = "1";
        $pro->save();
        return json_encode($pro);
    }


    public function update(Request $request, $id)
    {
        $pro = Profissional::find($id);
        if (isset($pro)) {
            $pro->nome = $request->input('nome');
            $pro->sexo = $request->input('sexo');
            $pro->data_nascimento = $request->input('data_nascimento');
            $pro->especialidade_id = $request->input('especialidade_id');
            $pro->cpf = $request->input('cpf');
            $pro->password = $request->input('cpf');
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
            $pro->ativo = "1";
            $pro->save();
            return json_encode($pro);
        }
        return response('Profissional não encontrado(a)', 404);
    }

    public function show($id)
    {
        $pro = Profissional::find($id);
        if (isset($pro)) {
            return json_encode($pro);
        }
        return response('Profissional não encontrado(a)', 404);
    }
}
