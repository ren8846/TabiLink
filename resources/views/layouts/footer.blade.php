<!-- <nav class="bottom-nav nav justify-content-around bg-white border-top" aria-label="Bottom navigation">
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
</nav> -->

<footer class="fixed bottom-0 inset-x-0 bg-white border-t">
  <nav class="max-w-7xl mx-auto px-2">
    <ul class="grid grid-cols-5 h-14 items-center text-center text-xs">
      <li>
        <a href="{{ route('home') }}"
           class="flex flex-col items-center justify-center h-full
                  {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 10.5 12 3l9 7.5"/><path d="M5 10v10h14V10"/>
          </svg>
          <span>ホーム</span>
        </a>
      </li>

      <li>
        <a href="#"
           class="flex flex-col items-center justify-center h-full text-gray-500 hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="11" cy="11" r="7"/><path d="m21 21-3.5-3.5"/>
          </svg>
          <span>検索</span>
        </a>
      </li>

      <li>
        <a href="#"
           class="flex flex-col items-center justify-center h-full text-gray-500 hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M12 5v14M5 12h14"/>
          </svg>
          <span>作成</span>
        </a>
      </li>

      <li>
        <a href="#"
           class="flex flex-col items-center justify-center h-full text-gray-500 hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M21 12a8 8 0 1 1-3-6.2L21 5l-.2 3A7.9 7.9 0 0 1 21 12Z"/><path d="M7 17l-4 2 1-4"/>
          </svg>
          <span>チャット</span>
        </a>
      </li>

      <li>
        <a href="#"
           class="flex flex-col items-center justify-center h-full text-gray-500 hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="8" r="3.2"/><path d="M4 20a8 8 0 0 1 16 0"/>
          </svg>
          <span>マイ</span>
        </a>
      </li>
    </ul>
  </nav>
</footer>
