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
}
