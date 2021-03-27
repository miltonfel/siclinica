<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacs = User::with(['convenio'])->where('convenio_id','<>', null)->get();
        return $pacs->toJson();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pac = new User();
        $pac->name = $request->input('name');
        $pac->sexo = $request->input('sexo');
        $pac->data_nascimento = $request->input('data_nascimento');
        $pac->convenio_id = $request->input('convenio_id');
        $pac->cpf = $request->input('cpf');
        $pac->password = $request->input('cpf');
        $pac->rg = $request->input('rg');
        $pac->telefone1 = $request->input('telefone1');
        $pac->telefone2 = $request->input('telefone2');
        $pac->cep = $request->input('cep');
        $pac->logradouro = $request->input('logradouro');
        $pac->numero = $request->input('numero');
        $pac->complemento = $request->input('complemento');
        $pac->bairro = $request->input('bairro');
        $pac->cidade = $request->input('cidade');
        $pac->uf = $request->input('uf');
        $pac->email = $request->input('email');
        $pac->obs = $request->input('obs');
        $pac->save();
        return json_encode($pac);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pac = User::with(['convenio'])->where('id', '=', $id)->get();
        if (isset($pac)){
            return json_encode($pac);
        }
        return response ('Paciente não encontrado(a)', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $pac = User::find($id);
        if (isset($pac)){
            $pac->name = $request->input('name');
            $pac->sexo = $request->input('sexo');
            $pac->data_nascimento = $request->input('data_nascimento');
            $pac->convenio_id = $request->input('convenio_id');
            $pac->cpf = $request->input('cpf');
            $pac->password = $request->input('cpf');
            $pac->rg = $request->input('rg');
            $pac->telefone1 = $request->input('telefone1');
            $pac->telefone2 = $request->input('telefone2');
            $pac->cep = $request->input('cep');
            $pac->logradouro = $request->input('logradouro');
            $pac->numero = $request->input('numero');
            $pac->complemento = $request->input('complemento');
            $pac->bairro = $request->input('bairro');
            $pac->cidade = $request->input('cidade');
            $pac->uf = $request->input('uf');
            $pac->email = $request->input('email');
            $pac->obs = $request->input('obs');
            $pac->save();
            return json_encode($pac);
        }
        return response ('Paciente não encontrado(a)', 404);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pac = User::find($id);
         if (isset($pac)){
           $pac->delete();
           return response('OK', 200);
       }
       return response ('Paciente não encontrado(a)', 404);
    }
}
