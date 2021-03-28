<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{

    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('google')->user();
        $users = User::where(['email' => $userSocial->getEmail()])->first();
        if ($users) {
            Auth::login($users);
            return redirect('/consultas');
        } else { //abrir tela para cadastrar usuario
            $user = User::create([
                'name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'image'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => 'google',
            ]);
            return redirect()->route('/login');
        }
    }
}
