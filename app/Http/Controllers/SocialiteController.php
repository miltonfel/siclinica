<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialiteController extends Controller
{
    protected function handleProviderCallback($data)
    {
        return "LOGIN GOOGLE RECEBIDO + $data";
        
    }
}
