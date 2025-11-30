<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $recipes = Recipe::with('user')->get();

        return view('home', compact('user', 'recipes'));
    }
}
