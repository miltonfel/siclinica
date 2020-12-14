<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use Illuminate\Http\Request;

class ConveniosController extends Controller
{
    public function index()
    {
        $convs = Convenio::all();
        return $convs->toJson();
    }
}
