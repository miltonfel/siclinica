<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;

class ConsultasController extends Controller
{
    public function index()
    {
        $conss = Consulta::with(['paciente'])->get();
        return $conss->toJson();
    }
}
