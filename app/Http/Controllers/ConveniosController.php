<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use Illuminate\Http\Request;

class ConveniosController extends Controller
{
    public function index()
    {
        $convs = Convenio::all();
        return $convs->toJson();
    }

    public function store(Request $request)
    {
        $con = new Convenio();
        $con->descricao = $request->input('descricao');
        $con->ativo = "1";
        $con->save();
        return json_encode($con);
    }

    public function show($id)
    {
        $con = Convenio::find($id);
        if (isset($con)){
            return json_encode($con);
        }
        return response ('Convênio não encontrado(a)', 404);
    }

    public function update(Request $request, $id)
    {
        $con = Convenio::find($id);
        if (isset($con)){
            $con->descricao = $request->input('descricao');
            $con->ativo = "1";
            $con->save();
            return json_encode($con);
        }
        return response ('Convênio não encontrado(a)', 404);
        
    }

    public function destroy($id)
    {
        $con = Convenio::find($id);
         if (isset($con)){
           $con->delete();
           return response('OK', 200);
       }
       return response ('Convênio não encontrado(a)', 404);
    }


}
