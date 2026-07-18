<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'bio',
        'price_per_hour',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'price_per_hour' => 'decimal:2',
        ];
    }

    // Portfolio
    public function realisations(): HasMany
    {
        return $this->hasMany(Realisation::class);
    }

    // Likes
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(
            Realisation::class,
            'likes'
        )->withTimestamps();
    }

    // Bookmarks
    public function saves(): BelongsToMany
    {
        return $this->belongsToMany(
            Realisation::class,
            'saves'
        )->withTimestamps();
    }

    // Skills
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(
            Skill::class,
            'skill_user'
        )->withTimestamps();
    }
}
