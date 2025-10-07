<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use Session;

use App\Models\User;
use App\Models\Corso;

class HomeController extends BaseController
{
    public function homeLogged()
    {   
        if (Session::get('id')) {
            $corsi = Corso::all(); 
            return view('index')->with([
                'user_id' => Session::get('id'),
                'corsi' => $corsi
            ]);

        } else {
            return redirect('login');
        }
    }

    public function aboutLogged(){
        if (Session::get('id')) { 
            return view('about')->with([
                'user_id' => Session::get('id')
            ]);

        } else {
            return redirect('login');
        }
    }
    
}