<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    function paciente(){
        return $this->belongsTo('App\Models\User')->where('tipo','like', 'paciente');
    }
    function profissional(){
        return $this->belongsTo('App\Models\User')->where('tipo','like', 'profissional');
    }
}
