<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->user();
        $this->_loginOrRegisterUser($user);
        return redirect()->route('posts');
    }
    protected function _loginOrRegisterUser($data){
        $user=User::where('email',$data->email)->first();
        if(!$user){
            $user=new User();
            $user->name=$data->name;
            $user->email=$data->email;
            $user->google_id=$data->id;
            $user->avatar=$data->avatar;
            $user->password=Hash::make('laravel@blog77');
            $user->save();
        }
        Auth::login($user);


    }
}
