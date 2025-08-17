<header class="app-header border-bottom bg-white">
  <div class="app-shell app-header-inner">
    <!-- {{-- 左：地図 --}} -->
    @if (Route::has('map'))
      <a href="{{ route('map') }}" class="icon-btn" aria-label="地図">
        <i class="bi bi-geo-alt" aria-hidden="true"></i><span class="visually-hidden">地図</span>
      </a>
    @else
      <span class="icon-btn"><i class="bi bi-geo-alt" aria-hidden="true"></i></span>
    @endif

    <h1 class="app-title">TabiLink</h1>

    <!-- {{-- 右：DM --}} -->
    @if (Route::has('dm'))
      <a href="{{ route('dm') }}" class="icon-btn" aria-label="DM">
        <i class="bi bi-send" aria-hidden="true"></i><span class="visually-hidden">DM</span>
      </a>
    @else
      <span class="icon-btn"><i class="bi bi-send" aria-hidden="true"></i></span>
    @endif
  </div>
</header>