<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Favorit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/tema.css') }}">
</head>

<body class="home-page">

  <div class="d-flex">
    @include('layouts.navigation')

    <div class="flex-grow-1 p-4">
      <h2 class="mb-4">Resep Favorit Kamu</h2>

      <div class="row">
        @forelse($recipes as $recipe)
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm">
            @if($recipe->image)
            <img src="{{ asset('storage/'.$recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}">
            @endif
            <div class="card-body">
              <h5 class="card-title">{{ $recipe->title }}</h5>
              <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>

              <div class="d-flex justify-content-between mt-3">
                {{-- Tombol Hapus Favorit --}}
                <form method="POST" action="{{ route('recipes.removeFavorite', $recipe->id) }}">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-danger">
                    <i class="bi bi-heart-fill"></i> Hapus Favorit
                  </button>
                </form>

                {{-- Tombol Hapus Resep (jika milik user) --}}
                @if($recipe->user_id === Auth::id())
                <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}" onsubmit="return confirm('Yakin ingin menghapus resep ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash-fill"></i> Hapus
                  </button>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12">
          <div class="alert alert-warning">Belum ada resep favorit.</div>
        </div>
        @endforelse
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>