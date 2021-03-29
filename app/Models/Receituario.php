<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receituario extends Model
{
    use HasFactory;
    function receituario(){
        return $this->belongsTo('App\Models\Receituario');
    }
}
