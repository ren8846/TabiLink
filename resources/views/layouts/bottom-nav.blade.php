<nav class="bottom-nav nav justify-content-around bg-white border-top" aria-label="Bottom navigation">
  <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="bi bi-house"></i></a>
  <a class="nav-link" href="#"><i class="bi bi-search"></i></a>
  <a class="nav-link" href="#"><i class="bi bi-plus-square"></i></a>
  <a class="nav-link" href="#"><i class="bi bi-chat-dots"></i></a>
  <a class="nav-link" href="#"><i class="bi bi-person"></i></a>
</nav>

