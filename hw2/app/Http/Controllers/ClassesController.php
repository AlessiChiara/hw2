<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use Session;

use App\Models\User;
use App\Models\Corso;
use App\Models\Iscrizione;

class ClassesController extends BaseController
{
    public function classesLogged()
    {   
        if (Session::get('id')) {
            $corsi = Corso::all(); 
            return view('classes')->with([
                'user_id' => Session::get('id'),
                'corsi' => $corsi
            ]);

        } else {
            return redirect('login');
        }
    }

    public function joinCourse(Request $request){
        $course_id = $request->input('course_id');
        $plan = $request->input('plan');

        $user_id = Session::get('id');
        $course = Corso::findOrFail($course_id);

        if ($course->n_iscritti >= $course->max_iscritti) {
            return response()->json(['status' => 'full']);
        }

        $alreadyJoined = Iscrizione::where('user_id', $user_id)
            ->where('corso_id', $course_id)
            ->exists();

        if ($alreadyJoined) {
            return response()->json(['status' => 'already_joined']);
        }

        $iscrizione = new Iscrizione();
        $iscrizione->user_id = $user_id;
        $iscrizione->corso_id = $course_id;
        $iscrizione->durata = $plan;
        $iscrizione->save();

        $course->increment('n_iscritti');

        return response()->json(['status' => 'joined']);
    }

}