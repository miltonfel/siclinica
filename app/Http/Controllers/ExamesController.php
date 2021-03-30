<?php

namespace App\Http\Controllers;

use App\Models\Exame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamesController extends Controller
{
    public function index()
    {
        $exas = Exame::all();
        return $exas->toJson();
    }

    public function store(Request $request)
    {
        $exa = new Exame();
        $exa->titulo = $request->input('titulo');
        $exa->descricao = $request->input('descricao');
        $exa->save();
        return json_encode($exa);
    }

    public function show($id)
    {
        $exa = Exame::find($id);
        if (isset($exa)){
            return json_encode($exa);
        }
        return response ('Exame não encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $exa = Exame::find($id);
        if (isset($exa)){
            $exa->titulo = $request->input('titulo');
            $exa->descricao = $request->input('descricao');
            $exa->save();
            return json_encode($exa);
        }
        return response ('Exame não encontrado', 404);
        
    }

    public function destroy($id)
    {
        $exa = Exame::find($id);
         if (isset($exa)){
           $exa->delete();
           return response('OK', 200);
       }
       return response ('Exame não encontrado', 404);
    }


}
