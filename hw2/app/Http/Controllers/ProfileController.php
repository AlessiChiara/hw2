<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use Session;

use App\Models\User;
use App\Models\Corso;
use App\Models\Iscrizione;

class ProfileController extends BaseController
{
    public function profileLogged()
    {
        if (Session::get('id')) {
            $fetch_profile = User::find(Session::get('id'));
            $iscrizioni = $fetch_profile->iscrizione()->with('corso')->get();
            foreach ($iscrizioni as $iscrizione) {
                $prezzoTotale = $iscrizione->corso->prezzo;
                switch ($iscrizione->durata) {
                    case 'mensile':
                        $prezzoTotale *= 1;
                        break;
                    case 'semestrale':
                        $prezzoTotale *= 6;
                        break;
                    case 'annuale':
                        $prezzoTotale *= 12;
                        break;
                }
                $iscrizione->prezzoTotale = $prezzoTotale;
            }
            return view('profile')->with([
                'user_id' => Session::get('id'),
                'fetch_profile' => $fetch_profile,
                'iscrizioni' => $iscrizioni
            ]);

        } else {
            return redirect('login');
        }
    }

    public function updateAddressLogged(){
        if (Session::get('id')) {
            return view('update_address')->with([
                'user_id' => Session::get('id'),
            ]);
        } else {
            return redirect('profile');
        }
    }

    public function updateAddress(Request $request)
    {
        if ($request->isMethod('post')) {
            $address = $request->input('indirizzo') . ', ' . $request->input('num_civico') . ', ' . 
                    $request->input('citta') . ', ' . $request->input('comune') . ', ' . 
                    $request->input('stato') . ', ' . $request->input('codice_postale');
            $address = filter_var($address, FILTER_SANITIZE_STRING);

            $user = User::find(Session::get('id'));
            $user->address = $address;
            $user->save();

        }
        return redirect('profile'); 
    }

    public function deleteIscrizione(Request $request){

        $iscrizione_id = $request->input('subscription_id');
        if(Iscrizione::where('id', $iscrizione_id)->delete()){
            $corso = Corso::find($request->course_id);
            $corso->n_iscritti--;
            $corso->save();
        }

        return redirect()->route('profile'); 
    }

    public function deleteAllIscrizione(){
        $user_id = Session::get('id');

        $iscrizioni = Iscrizione::where('user_id', $user_id)->get();
        $course_ids = $iscrizioni->pluck('corso_id')->unique()->toArray();

        Iscrizione::where('user_id', $user_id)->delete();


        foreach ($course_ids as $course_id) {
            $corso = Corso::find($course_id);
            if ($corso && $corso->n_iscritti > 0) {
                $corso->n_iscritti--;
                $corso->save();
            }
        }

        return redirect()->route('profile');
    }

}