<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, $recipeId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $recipe = Recipe::findOrFail($recipeId);

        // update jika user sudah pernah rating
        $recipe->ratings()->updateOrCreate(
            ['user_id' => Auth::id()],
            ['rating' => $request->rating]
        );

        return back()->with('success', 'Rating berhasil disimpan!');
    }
}
