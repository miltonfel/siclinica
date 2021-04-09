<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TiposController extends Controller
{
    public function index()
    {
        $tips = Tipo::all();
        return $tips->toJson();
    }

    public function store(Request $request)
    {
        $tip = new Tipo();
        $tip->descricao = $request->input('descricao');
        $tip->save();
        return json_encode($tip);
    }

    public function show($id)
    {
        $tip = Tipo::find($id);
        if (isset($tip)){
            return json_encode($tip);
        }
        return response ('Tipo não encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $tip = Tipo::find($id);
        if (isset($tip)){
            $tip->descricao = $request->input('descricao');
            $tip->save();
            return json_encode($tip);
        }
        return response ('Tipo não encontrado', 404);
        
    }

    public function destroy($id)
    {
        $tip = Tipo::find($id);
         if (isset($tip)){
           $tip->delete();
           return response('OK', 200);
       }
       return response ('Tipo não encontrado', 404);
    }


}
