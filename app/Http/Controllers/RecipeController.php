<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Recipe;
use App\Models\User;

class RecipeController extends Controller
{
    public function index()
    {
        // tampilan semua resep
        $recipes = Recipe::with('user')->latest()->get();
        return view('resep', compact('recipes'));

        $recipes = Recipe::with('ratings')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }

        $validated['user_id'] = Auth::id();
        Recipe::create($validated);

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil disimpan!');
    }

    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);

        // Pastikan hanya pemilik yang bisa hapus
        if ($recipe->user_id !== Auth::id()) {
            abort(403, 'Kamu tidak punya izin untuk menghapus resep ini.');
        }

        // Hapus gambar jika ada
        if ($recipe->image) {
            Storage::disk('public')->delete($recipe->image);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil dihapus.');
    }

    public function favorites()
    {
        $recipes = Auth::user()->favoriteRecipes()->with('user')->latest()->get();
        return view('favorit', compact('recipes'));
    }

    public function addFavorite($id)
    {
        $recipe = Recipe::findOrFail($id);
        $user = Auth::user();

        if (!$user->favoriteRecipes()->find($id)) {
            $user->favoriteRecipes()->attach($id);
        }

        return back()->with('success', 'Resep ditambahkan ke favorit.');
    }

    public function removeFavorite($id)
    {
        $recipe = Recipe::findOrFail($id);
        $user = Auth::user();

        if ($user->favoriteRecipes()->find($id)) {
            $user->favoriteRecipes()->detach($id);
        }

        return back()->with('success', 'Resep dihapus dari favorit.');
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        $isFavorited = Auth::user()->favoriteRecipes->contains($id);

        return view('show', compact('recipe', 'isFavorited'));
    }

    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('edit', compact('recipe'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $recipe = Recipe::findOrFail($id);

        // Update field biasa
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->content = $request->content;

        // Kalau ada file baru
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $recipe->image = $path;
        }

        $recipe->save();

        return redirect()->route('recipes.show', $recipe->id)
            ->with('success', 'Resep berhasil diperbarui!');
    }
}
