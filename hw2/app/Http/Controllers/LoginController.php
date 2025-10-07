<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\User;
use App\Models\Corso;

class LoginController extends BaseController
{
    public function loginLogged() {
        if(Session::get('id')){
            $corsi = Corso::all();
            return view('index')->with([
                'user_id' => Session::get('id'),
                'corsi' => $corsi
            ]);
        }else
            return view('login');
    }


    public function doLogin(Request $request)
    {
        
        $email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);
        $pass = $request->input('pass');

        $user = User::where('email', $email)->first();

        if ($user && Hash::check($pass, $user->password)) {
            Session::put('id', $user->id);
            return redirect()->route('home');
        } else {
            session()->flash('message', 'Email o password sbagliata!');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Session::forget('id');

        return redirect()->route('login');
    }
}

