<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        return view ('admin');
    }
}
