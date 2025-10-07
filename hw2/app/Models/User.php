<?php

namespace App\Models;
use App\Models\Iscrizione;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    public $timestamps = false;

    public function iscrizione() {
        return $this->hasMany(Iscrizione::class);
    }
}

