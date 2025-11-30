<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/tema.css') }}">
</head>

<body class="login-page">

  <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="auth-card">
      <h3 class="text-center mb-4">Login</h3>

      {{-- Notifikasi sukses (misalnya setelah register) --}}
      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- Notifikasi error login --}}
      @if($errors->any())
      <div class="alert alert-danger">
        {{ ucfirst($errors->first()) }}
      </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
        </div>

        <!-- Button -->
        <div class="d-grid">
          <button type="submit" class="btn btn-auth">Login</button>
        </div>
      </form>

      <div class="text-center mt-3">
        Belum punya akun? <a href="{{ route('register.form') }}" class="form-label" style="text-decoration: none;">Register</a>
      </div>
    </div>
  </div>

  @include('layouts.script')

</body>

</html>