<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkSpaceUser extends Model
{
    protected $table = 'workspace_user';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'workspace_id',
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
