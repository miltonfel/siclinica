<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use Illuminate\Support\Facades\DB;


class ConsultasController extends Controller
{
    public function index()
    {
        $conss = Consulta::with(['user'])->orderBy('agendamento', 'asc')->get();
        return $conss->toJson();
    }

    public function consultaPorData($data, $idProfissional)
    {
        $conss = Consulta::with(['paciente'])->where('agendamento', 'like', $data . '%')->where('profissional_id', $idProfissional)->orderBy('agendamento', 'asc')->get();
        return $conss->toJson();
    }

    public function consultaPorPaciente($idPaciente)
    {
        $conss = Consulta::with(['profissional'])->where('paciente_id', $idPaciente)->orderBy('agendamento', 'desc')->get();
        return $conss->toJson();
    }

    public function abrirConsulta($id)
    {
        $con = Consulta::with(['paciente'])->where('id', $id)->get();
        return $con->toJson();
    }

    public function buscarPacienteNome($name)
    {
        //$name = $name+'/%';
        $pacs = DB::table('users')->where('name', 'like', $name . '%')->get();
        return $pacs->toJson();
    }

    public function cancelarConsulta($id)
    {
        $con = Consulta::find($id);
        if (isset($con)) {
            if ($con->status != 'Finalizada') {
                $con->status = 'Cancelada';
                $con->save();
                return 'Consulta Cancelada';
            } else return 'Não é possível cancelar uma consulta já finalizada';
        }
        return 'Consulta não encontrada';
    }

    public function confirmarConsulta($id)
    {
        $con = Consulta::find($id);
        if (isset($con)) {
            if ($con->status != 'Finalizada') {
            $con->status = 'Confirmada';
            $con->save();
            return 'Consulta Confirmada';
            } else return 'Não é possivel confirmar uma consulta já finalizada';
        }
        return 'Consulta não encontrada';
    }

    public function cadastrarConsulta(Request $request)
    {
        $con = new Consulta();
        $con->agendamento = $request->input('agendamento');
        $con->convenio_id = '1'; //acertar a busca desse campo
        $con->profissional_id = $request->input('profissional_id');
        $con->paciente_id = $request->input('paciente_id');
        $con->motivo = $request->input('motivo');
        $con->status = 'Agendada';
        $con->save();
        //return json_encode($con);
        return view('/consultas');
    }

    public function update(Request $request, $id)
    {
        $con = Consulta::find($id);
        if (isset($con)) {
            $con->status = 'Finalizada';
            $con->motivo = $request->input('motivo');
            $con->diagnostico = $request->input('diagnostico');
            $con->receita = $request->input('receita');
            $con->exame = $request->input('exame');
            $con->save();
            return response('Consulta atualizada', 200);
        }
        return response('Consulta não encontrado(a)', 404);
    }
}
