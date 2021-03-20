<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;

class EspecialidadesController extends Controller
{
    public function index()
    {
        $esps = Especialidade::all();
        return $esps->toJson();
    }


    public function store(Request $request)
    {
        $esp = new Especialidade();
        $esp->descricao = $request->input('descricao');
        $esp->save();
        return json_encode($esp);
    }

    public function show($id)
    {
        $esp = Especialidade::find($id);
        if (isset($esp)){
            return json_encode($esp);
        }
        return response ('Especialidade não encontrada', 404);
    }

    public function update(Request $request, $id)
    {
        $esp = Especialidade::find($id);
        if (isset($esp)){
            $esp->descricao = $request->input('descricao');
            $esp->save();
            return json_encode($esp);
        }
        return response ('Especialidade não encontrada', 404);
        
    }

    public function destroy($id)
    {
        $esp = Especialidade::find($id);
         if (isset($esp)){
           $esp->delete();
           return response('OK', 200);
       }
       return response ('Especialidade não encontrada', 404);
    }
}
