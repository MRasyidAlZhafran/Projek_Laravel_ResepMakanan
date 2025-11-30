<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<div class="sidebar bg-warning text-white p-3" style="width: 220px; min-height: 100vh;">
  <h4 class="mb-4">Menu</h4>
  <ul class="nav flex-column">
    <li class="nav-item mb-2">
      <a href="{{ route('home') }}" class="nav-link text-white">
        <i class="bi bi-house-door-fill me-2"></i> Home
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="{{ route('recipes.index') }}" class="nav-link text-white">
        <i class="bi bi-book-fill me-2"></i> Resep
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="{{ route('recipes.favorites') }}" class="nav-link text-white">
        <i class="bi bi-star-fill me-2"></i> Favorit
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="{{ route('profile') }}" class="nav-link text-white">
        <i class="bi bi-person-circle me-2"></i> Profil
      </a>
    </li>
    <li class="nav-item mt-3">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-light w-100">
          <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
      </form>
    </li>
  </ul>
</div>

@include('layouts.script')