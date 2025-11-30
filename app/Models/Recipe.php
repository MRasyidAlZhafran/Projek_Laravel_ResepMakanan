<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['title', 'description', 'content', 'image', 'user_id'];

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'recipe_favorites');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
