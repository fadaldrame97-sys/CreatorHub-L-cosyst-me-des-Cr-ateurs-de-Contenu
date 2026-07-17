<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    public function realisations()
{
    return $this->belongsToMany(Realisation::class);
}
}
