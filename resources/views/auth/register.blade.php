<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/tema.css') }}">
</head>

<body class="register-page">

  <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="auth-card">
      <h3 class="text-center mb-4">Register</h3>

      {{-- Notifikasi sukses --}}
      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- Notifikasi error umum --}}
      @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
          <li>{{ ucfirst($error) }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required>
          @error('name')
          <div class="text-danger small">{{ ucfirst($message) }}</div>
          @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
          @error('email')
          <div class="text-danger small">{{ ucfirst($message) }}</div>
          @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
          @error('password')
          <div class="text-danger small">{{ ucfirst($message) }}</div>
          @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
          @error('password_confirmation')
          <div class="text-danger small">{{ ucfirst($message) }}</div>
          @enderror
        </div>

        <!-- Button -->
        <div class="d-grid">
          <button type="submit" class="btn btn-auth">Daftar</button>
        </div>
      </form>

      <div class="text-center mt-3">
        Sudah punya akun? <a href="{{ route('login.form') }}" class="form-label" style="text-decoration: none;">Login</a>
      </div>
    </div>
  </div>

  @include('layouts.script')

</body>

</html>