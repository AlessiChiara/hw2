<?php

use Illuminate\Support\Facades\Route;
use App\Models\Corso;


Route::get('/', function () {
    if(Session::get('id')){
        $corsi = Corso::all(); 
            return view('index')->with([
                'user_id' => Session::get('id'),
                'corsi' => $corsi
        ]);
    }else
        return view('login');
});


Route::post('login', 'App\Http\Controllers\LoginController@doLogin')->name('doLogin');
Route::post('register', 'App\Http\Controllers\RegisterController@do_register')->name('register');

//navigazione
Route::get('index', 'App\Http\Controllers\HomeController@homeLogged')->name('home');
Route::get('logout','App\Http\Controllers\LoginController@logout');
Route::get('login', 'App\Http\Controllers\LoginController@loginLogged')->name('login');
Route::get('register', 'App\Http\Controllers\RegisterController@registerLogged');
Route::get('about', 'App\Http\Controllers\HomeController@aboutLogged')->name('about');
Route::get('classes', 'App\Http\Controllers\ClassesController@classesLogged')->name('classes');
Route::get('profile', 'App\Http\Controllers\ProfileController@profileLogged')->name('profile');
Route::get('update-address', 'App\Http\Controllers\ProfileController@updateAddressLogged')->name('update_address');
Route::get('exercises', 'App\Http\Controllers\ExercisesController@exercisesLogged')->name('allenamenti');
//-----------

Route::post('join_course', 'App\Http\Controllers\ClassesController@joinCourse');

Route::post('update_address', 'App\Http\Controllers\ProfileController@updateAddress');

Route::post('delete_iscrizione', 'App\Http\Controllers\ProfileController@deleteIscrizione');
Route::post('deleteAll_iscrizione', 'App\Http\Controllers\ProfileController@deleteAllIscrizione');

Route::get('get_exercises', 'App\Http\Controllers\ExercisesController@fetchExercises');






