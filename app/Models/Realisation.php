<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Realisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'media_url',
        'media_type',
        'cover_image',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(
            Skill::class,
            'realisation_skill'
        )->withTimestamps();
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'likes'
        )->withTimestamps();
    }

    public function saves(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'saves'
        )->withTimestamps();
    }
}
