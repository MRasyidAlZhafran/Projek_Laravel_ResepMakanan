<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Edit Resep</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/tema.css') }}">
</head>

<body class="bg-light">

  <div class="container py-5">
    <h2 class="mb-4">Edit Resep</h2>

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Judul --}}
      <div class="mb-3">
        <label for="title" class="form-label">Judul Resep</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $recipe->title) }}" required>
      </div>

      {{-- Deskripsi --}}
      <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $recipe->description) }}</textarea>
      </div>

      {{-- Gambar --}}
      <div class="mb-3">
        <label for="image" class="form-label">Gambar Resep</label>
        <input type="file" name="image" id="image" class="form-control">
        @if($recipe->image)
        <div class="mt-2">
          <img src="{{ asset('storage/'.$recipe->image) }}" class="img-fluid rounded" style="max-height: 200px;">
          <small class="text-muted d-block mt-1">Gambar saat ini: {{ $recipe->image }}</small>
        </div>
        @endif
      </div>

      {{-- Langkah Langkah --}}
      <div class="mb-3">
        <label for="content" class="form-label">Konten Resep</label>
        <textarea name="content" id="content" class="form-control" rows="6" required>{{ old('content', $recipe->content) }}</textarea>
        <small class="text-muted">Isi lengkap resep, bisa berupa narasi, penjelasan, atau catatan khusus.</small>
      </div>


      {{-- Tombol Simpan --}}
      <div class="d-grid mt-4">
        <button type="submit" class="btn btn-auth">
          <i class="bi bi-save"></i> Simpan Perubahan
        </button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>