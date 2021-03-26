<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class SocialiteController extends Controller
{
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        $nome = $user->getName();
        $email = $user->getEmail();
        $foto = $user->getAvatar();

        $tipousuario = confereCadastro($email);
        return $tipousuario;
    }

}

function confereCadastro($email){
    return "Paciente";
}
