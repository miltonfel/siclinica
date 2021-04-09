<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;

class pdfController extends Controller
{
    public function gerarReceita($nomeProfissional, $nomePaciente, $texto)
    {
        //dd($nomeProfissional, $nomePaciente, $texto);
        $dados = [
            "nomeProfissional" => $nomeProfissional,
            "nomePaciente" => $nomePaciente,
            "texto" => $texto,
        ];
        //dd($dados);
        //return view ('receita',$dados);
        $pdf = PDF::loadView('receita', $dados);
        return $pdf->setPaper('a4')->stream('receita.pdf');
    }

    public function gerarExame($nomeProfissional, $nomePaciente, $texto)
    {
        //dd($nomeProfissional, $nomePaciente, $texto);
        $dados = [
            "nomeProfissional" => $nomeProfissional,
            "nomePaciente" => $nomePaciente,
            "texto" => $texto,
        ];
        //dd($dados);
        //return view ('receita',$dados);
        $pdf = PDF::loadView('pedidoExame', $dados);
        return $pdf->setPaper('a4')->stream('pedido_exame.pdf');
    }
}
