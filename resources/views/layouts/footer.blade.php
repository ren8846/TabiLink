<nav class="bottom-nav nav justify-content-around bg-white border-top" aria-label="Bottom navigation">
  <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
     href="{{ route('home') }}" aria-label="Home">
    <i class="bi bi-house"></i>
  </a>

  <a class="nav-link {{ request()->routeIs('search') ? 'active' : '' }}"
     href='#' aria-label="Search">
    <i class="bi bi-search"></i>
  </a>


  <a class="nav-link {{ request()->routeIs('post.*') ? 'active' : '' }}"
     href='#' aria-label="Create">
    <i class="bi bi-plus-square"></i>
  </a>

  <a class="nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}"
     href='#' aria-label="Chat">
    <i class="bi bi-chat-dots"></i>
  </a>

  <a class="nav-link {{ request()->routeIs('mypage') ? 'active' : '' }}"
     href='#' aria-label="My Page">
    <i class="bi bi-person"></i>
  </a>
</nav>
