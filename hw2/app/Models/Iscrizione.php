<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Corso;

class Iscrizione extends Model
{
    public $timestamps = false;

    protected $table = "iscrizione";

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function corso() {
        return $this->belongsTo(Corso::class);
    }
}