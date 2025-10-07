<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Iscrizione;


class Corso extends Model
{
    public $timestamps = false;

    protected $table = "corso";

    public function iscrizione() {
        return $this->hasMany(Iscrizione::class);
    }
}