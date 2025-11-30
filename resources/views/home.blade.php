<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/tema.css') }}">
</head>

<body class="home-page">

  <div class="d-flex">
    @include('layouts.navigation')
    <div class="flex-grow-1 p-4 text-dark">
      <h2>Selamat datang, {{ Auth::user()->name }}</h2>
      <p>Aplikasi untuk membuat resep dan pencari resep yang anda inginkan.</p>
    </div>
    {{-- Konten Utama --}}
    <div class="flex-grow-1 p-4">
      <h2 class="mb-4">Resep Terbaru</h2>

      <div class="row">
        @foreach($recipes as $recipe)
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm">
            {{-- Gambar resep --}}
            <img src="{{ asset('storage/'.$recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}">

            <div class="card-body">
              <h5 class="card-title">{{ $recipe->title }}</h5>
              <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>

              {{-- Rating bintang --}}
              <div class="mb-2">
                @for($i = 1; $i <= 5; $i++)
                  @if($i <=$recipe->rating)
                  <i class="bi bi-star-fill text-warning"></i>
                  @else
                  <i class="bi bi-star text-warning"></i>
                  @endif
                  @endfor
              </div>

              {{-- Tombol favorit --}}
              <form method="POST" action="{{ route('recipes.addFavorite', $recipe->id) }}">
                @csrf
                <button type="submit" class="btn btn-sm {{ $recipe->is_favorite ? 'btn-danger' : 'btn-outline-danger' }}">
                  <i class="bi bi-heart-fill"></i>
                  {{ $recipe->is_favorite ? 'Hapus Favorit' : 'Favorit' }}
                </button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

  </div>
  @include('layouts.script')

</body>

</html>