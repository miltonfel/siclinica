<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;
    function pacientes(){
        return $this->hasMany('App\Models\Paciente')->orderBy('descricao', 'asc');
    }
}
