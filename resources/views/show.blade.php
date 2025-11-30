<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $recipe->title }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="home-page">

  <div class="container py-4">
    <a href="{{ route('recipes.index') }}" class="btn btn-sm btn-secondary mb-3">
      <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="card shadow-sm">
      @if($recipe->image)
      <img src="{{ asset('storage/'.$recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}">
      @endif

      <div class="card-body">
        <h3 class="card-title">{{ $recipe->title }}</h3>
        <p class="text-muted">{{ $recipe->description }}</p>

        <h5 class="mt-4">Langkah-langkah:</h5>
        <p>{!! nl2br(e($recipe->content)) !!}</p>

        <form action="{{ route('recipes.rate', $recipe->id) }}" method="POST">
          @csrf
          <label>Berikan Rating:</label>
          <select name="rating" class="form-select w-auto d-inline">
            @for($i=1; $i<=5; $i++)
              <option value="{{ $i }}">{{ $i }} ★</option>
              @endfor
          </select>
          <button type="submit" class="btn btn-sm btn-warning">Simpan</button>
        </form>

        <p class="mt-2">Rata-rata rating: {{ number_format($recipe->averageRating(), 1) }} ★</p>

        <div class="d-flex justify-content-between mt-4">
          @php
          $isFavorited = Auth::user()->favoriteRecipes->contains($recipe->id);
          @endphp

          @if(!$isFavorited)
          <form method="POST" action="{{ route('recipes.addFavorite', $recipe->id) }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-secondary">
              <i class="bi bi-heart"></i> Tambah Favorit
            </button>
          </form>
          @endif

          @if($recipe->user_id === Auth::id())
          <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}" onsubmit="return confirm('Yakin ingin menghapus resep ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">
              <i class="bi bi-trash-fill"></i> Hapus Resep
            </button>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>