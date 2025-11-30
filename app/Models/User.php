<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Recipe;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Relasi resep favorit milik user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoriteRecipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_favorites');
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
