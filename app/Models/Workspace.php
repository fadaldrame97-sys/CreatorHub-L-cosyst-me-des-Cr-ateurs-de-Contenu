<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Workspace extends Model
{
    protected $table = 'workspace_user';
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function workspaceusers(){
        return $this->hasMany(WorkSpaceUser::class);
    }
     public function skills(){
        return $this->hasMany(Skill::class);
    }
}
