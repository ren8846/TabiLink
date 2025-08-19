<header class="bg-white border-b">
  <div class="max-w-7xl mx-auto h-14 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
    <!-- {{-- 左：地図 --}} -->
    @if (Route::has('map'))
      <a href="{{ route('map') }}" class="p-2 rounded hover:bg-gray-100" aria-label="地図">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M12 22s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11Z"/><circle cx="12" cy="11" r="2.5"/>
        </svg>
        <span class="sr-only">地図</span>
      </a>
    @else
      <span class="p-2 text-gray-400" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"><circle cx="12" cy="12" r="10" fill="currentColor"/></svg>
      </span>
    @endif

    <h1 class="text-lg font-semibold text-gray-800">TabiLink</h1>

    <!-- {{-- 右：DM --}} -->
    @if (Route::has('dm.index')) 
      <a href="{{ route('dm.index') }}"
         class="p-2 rounded hover:bg-gray-100 {{ request()->routeIs('dm.*') ? 'text-blue-600' : 'text-gray-700' }}"
         aria-label="DM" title="DM">
        <i class="bi bi-chat-dots text-xl"></i> {{-- Tailwindでサイズ指定 --}}
        <span class="sr-only">DM</span>
      </a>
    @else
      <span class="p-2 text-gray-400" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"><circle cx="12" cy="12" r="10" fill="currentColor"/></svg>
      </span>
    @endif
  </div>
</header>
