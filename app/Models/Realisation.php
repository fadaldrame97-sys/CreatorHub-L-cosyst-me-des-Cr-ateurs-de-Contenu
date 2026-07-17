<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realisation extends Model
{
    //
    public function user()
{
    return $this->belongsTo(User::class);
}

public function skills()
{
    return $this->belongsToMany(Skill::class);
}

public function likes()
{
    return $this->hasMany(Like::class);
}

public function saves()
{
    return $this->hasMany(Save::class);
}
}
