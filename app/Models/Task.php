<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        "workspace_id",
        "assigned_to",
        "title",
        "description",
        "status"
    ];
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function workspaces(){
        return $this->belongsTo(Workspace::class);
    }
}
