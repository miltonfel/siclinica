<?php

namespace App\Http\Controllers;

use App\Models\Receituario;
use Illuminate\Http\Request;

class ReceituariosController extends Controller
{
    public function index()
    {
        $recs = Receituario::all();
        return $recs->toJson();
    }

    public function store(Request $request)
    {
        $rec = new Receituario();
        $rec->titulo = $request->input('titulo');
        $rec->descricao = $request->input('descricao');
        $rec->save();
        return json_encode($rec);
    }

    public function show($id)
    {
        $rec = Receituario::find($id);
        if (isset($rec)){
            return json_encode($rec);
        }
        return response ('Receita não encontrada', 404);
    }

    public function update(Request $request, $id)
    {
        $rec = Receituario::find($id);
        if (isset($rec)){
            $rec->titulo = $request->input('titulo');
            $rec->descricao = $request->input('descricao');
            $rec->save();
            return json_encode($rec);
        }
        return response ('Receita não encontrada', 404);
        
    }

    public function destroy($id)
    {
        $rec = Receituario::find($id);
         if (isset($rec)){
           $rec->delete();
           return response('OK', 200);
       }
       return response ('Receita não encontrada', 404);
    }


}
