<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Resep</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/tema.css') }}">
</head>

<body class="home-page">
  <div class="d-flex">
    @include('layouts.navigation')

    <div class="flex-grow-1 p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Resep</h2>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#createRecipeModal">
          <i class="bi bi-plus-circle"></i> Buat Resep
        </button>
      </div>

      {{-- Daftar Resep --}}
      <div class="row">
        @forelse($recipes as $recipe)
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            @if($recipe->image)
            <img src="{{ asset('storage/'.$recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}">
            @endif

            <div class="card-body d-flex flex-column">
              <h5 class="card-title">
                <a href="{{ route('recipes.show', $recipe->id) }}" class="text-decoration-none text-dark">
                  {{ $recipe->title }}
                </a>
              </h5>
              <p class="card-text text-muted">{{ Str::limit($recipe->description, 100) }}</p>

              {{-- Tombol Aksi --}}
              <div class="d-flex flex-wrap gap-2 mt-auto">
                @php
                $isFavorited = Auth::user()->favoriteRecipes->contains($recipe->id);
                @endphp

                @if(!$isFavorited)
                <form method="POST" action="{{ route('recipes.addFavorite', $recipe->id) }}">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-outline-secondary" style="padding: 7px;">
                    <i class="bi bi-heart"></i> Favorit
                  </button>
                </form>
                @endif

                @if($recipe->user_id === Auth::id())
                <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-auth">
                  <i class="bi bi-pencil-square"></i> Edit
                </a>

                <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}" onsubmit="return confirm('Yakin ingin menghapus resep ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger" style="padding: 7px;">
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
          <div class="alert alert-warning">Belum ada resep yang dibuat.</div>
        </div>
        @endforelse
      </div>
    </div>

    {{-- Modal Buat Resep --}}
    <div class="modal fade" id="createRecipeModal" tabindex="-1" aria-labelledby="createRecipeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data" class="modal-content">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="createRecipeModalLabel">Buat Resep Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="title" class="form-label">Judul Resep</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Gambar Makanan</label>
              <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">Isi Resep / Langkah-langkah</label>
              <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning">Simpan Resep</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>