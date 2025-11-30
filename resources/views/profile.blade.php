<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<body class="bg-light">
  <div class="d-flex min-vh-100">
    {{-- Sidebar --}}
    <div class="bg-dark text-white p-3" style="width: 250px;">
      @include('layouts.navigation')
    </div>

    {{-- Konten Utama --}}
    <div class="flex-grow-1 p-4">
      <div class="container">
        <h2 class="mb-4">Profil Pengguna</h2>

        {{-- Info Pengguna --}}
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text">Email: {{ $user->email }}</p>
            <p class="card-text">Total Resep Dibuat: {{ $recipes->count() }}</p>
            <p class="card-text">Total Favorit: {{ $favorites ? $favorites->count() : 0 }}</p>
          </div>
        </div>

        {{-- Resep Saya --}}
        <h4 class="mb-3">Resep Saya</h4>
        <div class="row">
          @forelse($recipes as $recipe)
          <div class="col-12 col-sm-6 col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              @if($recipe->image)
              <img src="{{ asset('storage/'.$recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}">
              @endif
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $recipe->title }}</h5>
                <p class="card-text text-muted">{{ Str::limit($recipe->description, 100) }}</p>
                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-warning mt-auto">Lihat Resep</a>
              </div>
            </div>
          </div>
          @empty
          <p class="text-muted">Belum ada resep yang dibuat.</p>
          @endforelse
        </div>

        {{-- Resep Favorit --}}
        <h4 class="mt-5 mb-3">Resep Favorit Saya</h4>
        <div class="row">
          @forelse($favorites as $recipe)
          <div class="col-12 col-sm-6 col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              @if($recipe->image)
              <img src="{{ asset('storage/'.$recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}">
              @endif
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $recipe->title }}</h5>
                <p class="card-text text-muted">{{ Str::limit($recipe->description, 100) }}</p>
                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-warning mt-auto">Lihat Resep</a>
              </div>
            </div>
          </div>
          @empty
          <p class="text-muted">Belum ada resep favorit.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>