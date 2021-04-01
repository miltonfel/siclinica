<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{

    use HasFactory;
    function tipo(){
        return $this->belongsTo('App\Models\Tipo');
    }
}
