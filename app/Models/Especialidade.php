<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    use HasFactory;
    function profissionais(){
        return $this->hasMany('App\Models\Profissional')->orderBy('descricao', 'asc');
    }
}
