<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Profil Pengguna</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/tema.css') }}">
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<body>

  @include('layouts.navigation')

  <div class="container py-4">
    <h2>Profil Pengguna</h2>

    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title">{{ $user->name }}</h5>
        <p class="card-text">Email: {{ $user->email }}</p>
        <p class="card-text">Total Resep Dibuat: {{ $recipes->count() }}</p>
        <p class="card-text">Total Favorit: {{ $favorites ? $favorites->count() : 0 }}</p>
      </div>
    </div>

    <h4>Resep Saya</h4>
    <div class="row">
      @forelse($recipes as $recipe)
      <div class="col-md-4 mb-3">
        <div class="card h-100">
          @if($recipe->image)
          <img src="{{ asset('storage/'.$recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $recipe->title }}</h5>
            <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
            <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-auth">Lihat Resep</a>
          </div>
        </div>
      </div>
      @empty
      <p class="text-muted">Belum ada resep yang dibuat.</p>
      @endforelse
    </div>

    <h4 class="mt-5">Resep Favorit Saya</h4>
    <div class="row">
      @forelse($favorites as $recipe)
      <div class="col-md-4 mb-3">
        <div class="card h-100">
          @if($recipe->image)
          <img src="{{ asset('storage/'.$recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $recipe->title }}</h5>
            <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
            <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-auth">Lihat Resep</a>
          </div>
        </div>
      </div>
      @empty
      <p class="text-muted">Belum ada resep favorit.</p>
      @endforelse
    </div>
  </div>

</body>

</html>