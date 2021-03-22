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

    public function cadastrarConsulta(Request $request){
        $con = new Consulta();
        $con->agendamento = $request->input('agendamento');
        $con->convenio_id = '1';//acertar a busca desse campo
        $con->profissional_id = $request->input('profissional_id');
        $con->paciente_id = $request->input('paciente_id');
        $con->motivo = $request->input('motivo');
        $con->status = $request->input('Agendado');
        
      
        $con->ativo = "1";
        $con->save();
        return json_encode($con);
    }
}
