<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    //
    public function user()
{
    return $this->belongsTo(User::class);
}

public function realisation()
{
    return $this->belongsTo(Realisation::class);
}
}
