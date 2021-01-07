<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profissional extends Model
{
    protected $table = 'profissionais';
    use HasFactory;
    function especialidade(){
        return $this->belongsTo('App\Models\Especialidade');
    }
}
