<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use Session;

use App\Models\User;

class ExercisesController extends BaseController
{
    public function exercisesLogged()
    {   
        if (Session::get('id')) { 
            return view('allenamenti')->with([
                'user_id' => Session::get('id')
            ]);

        } else {
            return redirect('login');
        }
    }

    public function fetchExercises(Request $request)
    {
        $limit = $request->query('limit');
        $offset = $request->query('offset');

        $url = 'https://wger.de/api/v2/exercisebaseinfo/?=&limit=' . $limit . '&offset=' . $offset;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Authorization: Token ' . '62e95f2d76b4aefd161d1f16cd487a5bb3ad3db0';
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return response()->json(['error' => curl_error($ch)], 500);
        }
        curl_close($ch);

        return response()->json(json_decode($result), 200);

    }
    
    
}