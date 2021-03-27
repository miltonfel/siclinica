<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    function paciente(){
        return $this->belongsTo('App\Models\User')->where('convenio_id','<>', null);
    }
    function profissional(){
        return $this->belongsTo('App\Models\User')->where('especialidade_id','<>', null);
    }
}
