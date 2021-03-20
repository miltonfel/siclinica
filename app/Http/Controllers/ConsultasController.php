<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use Illuminate\Support\Facades\DB;


class ConsultasController extends Controller
{
    public function index()
    {
        $conss = Consulta::with(['paciente'])->get();
        return $conss->toJson();
    }

    public function buscarPacienteNome($nome){
        //$nome = $nome+'/%';
        $pacs = DB::table('pacientes')->where('nome', 'like', $nome.'%' )->get();
        return $pacs->toJson();

    }
}
