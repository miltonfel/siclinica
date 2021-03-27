<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;

class SocialiteController extends Controller
{
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        $nome = $user->getName();
        $email = $user->getEmail();
        $foto = $user->getAvatar();

        $existeCadastro = confereCadastro($email);
        if ($existeCadastro == false){
            return "Iniciar casdastro novo";
        }
        else return "Linkar ou login";
        
    }

}

function confereCadastro($email){
    $user = User::with(['convenio'])->where('email', $email)->get();
    if (isset ($user[0]->email)) return $user; //email já existe no cadastro de usuário
    else return false; //e-mail não existe no cadastro
    /*
        if ($user[0]->password = 'usuario sem acesso'){
            return 'Linkar usuario com pre cadastro';
        }
        else {
            return 'Usuário já existente, prosseguir para login';
        }
    }
    else return "Usuário não cadastrado";*/
}
