<nav class="bottom-nav nav justify-content-around bg-white border-top" role="navigation" aria-label="Bottom">
  <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" aria-label="Home"><i class="bi bi-house"></i></a>

  <a class="nav-link" href="#" aria-label="Search"><i class="bi bi-search"></i></a>

  @if (Route::has('post.create'))
    <a class="nav-link" href="{{ route('post.create') }}" aria-label="Create"><i class="bi bi-plus-square"></i></a>
  @else
    <a class="nav-link" href="#" aria-label="Create"><i class="bi bi-plus-square"></i></a>
  @endif
  

  <a class="nav-link" href="#" aria-label="Chat"><i class="bi bi-chat-dots"></i></a>
  <a class="nav-link" href="#" aria-label="My Page"><i class="bi bi-person"></i></a>
</nav>
