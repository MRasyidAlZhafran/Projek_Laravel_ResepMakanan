<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;

class UserController extends Controller
{

    public function profile()
    {
        $user = Auth::user();
        $recipes = $user->recipes ?? collect();
        $favorites = $user->favoriteRecipes ?? collect(); // pastikan tidak null

        return view('profile', compact('user', 'recipes', 'favorites'));
    }
}
