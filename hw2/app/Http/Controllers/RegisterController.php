<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use App\Models\Corso;

class RegisterController extends BaseController
{
    public function registerLogged() {
        if(Session::get('id')){
            $corsi = Corso::all();
            return view('index')->with([
                'user_id' => Session::get('id'),
                'corsi' => $corsi
            ]);
        }else
            return view('register');
    }

    public function do_register(Request $request) {

        $name = $request->input('name');
        if (empty($name) || !preg_match('/^[a-zA-Z ]+$/', $name)) {
            $errors = 'Il campo nome è obbligatorio e può contenere solo lettere e spazi.';
        }
    
        $email = $request->input('email');
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors = 'Il campo email è obbligatorio e deve essere un indirizzo email valido.';
        }
    
        $number = $request->input('number');
        if (empty($number) || !preg_match('/^\d+$/', $number)) {
            $errors = 'Il campo numero è obbligatorio e può contenere solo numeri.';
        }

        if($request->address != ''){
            $address = $request->input('address');
        }
        
    
        $pass = $request->input('pass');
        $cpass = $request->input('cpass');
        if (empty($pass) || empty($cpass)) {
            $errors = 'Entrambi i campi password sono obbligatori.';
        } elseif (!preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass) || !preg_match('/[^a-zA-Z\d]/', $pass)) {
            $errors = 'La password deve contenere almeno una lettera maiuscola, un numero, un carattere speciale e deve essere di almeno 8 caratteri.';
        } elseif ($pass != $cpass) {
            $errors = 'Le password non corrispondono.';
        }
    
        if (!empty($errors)) {
            session()->flash('message', $errors);
            return redirect()->back()->withInput();
        }
    
        
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $number = filter_var($number, FILTER_SANITIZE_STRING);
        $address = filter_var($address, FILTER_SANITIZE_STRING);

    
        $userExists = User::where('email', $email)->orWhere('number', $number)->exists();
        if ($userExists) {
            session()->flash('message', 'Email o numero già esistente nel database.');
            return redirect()->back()->withInput();
        }

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->number = $number;
        $user->address = $address;
        $user->password = bcrypt($pass);
        $user->save();
    
        Session::put('id', $user->id);
    
        return redirect()->route('home');
    }
    
}
