<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    @php
      // ルート名の揺れを吸収（存在するものを自動採用）
      $mapRoute = Route::has('map.index') ? 'map.index' : (Route::has('map') ? 'map' : null);
      $dmRoute  = Route::has('dm.index')  ? 'dm.index'  : (Route::has('dm')  ? 'dm'  : null);
    @endphp

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:-my-px sm:ms-10 sm:flex space-x-8">
                    <!-- Dashboard -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Map（存在するときだけ表示） -->
                    @if ($mapRoute)
                        <x-nav-link :href="route($mapRoute)" :active="request()->routeIs($mapRoute)">
                            <span class="inline-flex items-center gap-1">
                                <!-- Heroicon: map-pin -->
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M11.54 22.35a.75.75 0 00.92 0c1.2-.94 6.96-5.62 6.96-10.35A7.5 7.5 0 009 3.75 7.5 7.5 0 003.5 12c0 4.73 5.76 9.41 6.96 10.35zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                                </svg>
                                <span>Map</span>
                            </span>
                        </x-nav-link>
                    @endif

                    <!-- DM（ログイン時のみ。未ログインはログインへ誘導） -->
                    @auth
                        @if ($dmRoute)
                            <x-nav-link :href="route($dmRoute)" :active="request()->routeIs('dm.*')">
                                <span class="inline-flex items-center gap-1">
                                    <!-- Heroicon: paper-airplane -->
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M2.31 12.87l17.28-7.02a.75.75 0 01.97.98l-7.02 17.28a.75.75 0 01-1.38.04L9.9 16.3l6.4-6.4-8.17 5.25-5.55-2.28a.75.75 0 01-.27-1.0z"/>
                                    </svg>
                                    <span>DM</span>
                                </span>
                            </x-nav-link>
                        @endif
                    @else
                        <x-nav-link :href="route('login')" :active="false">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M2.31 12.87l17.28-7.02a.75.75 0 01.97.98l-7.02 17.28a.75.75 0 01-1.38.04L9.9 16.3l6.4-6.4-8.17 5.25-5.55-2.28a.75.75 0 01-.27-1.0z"/>
                                </svg>
                                <span>DM</span>
                            </span>
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                              class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ auth()->user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                     onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">ログイン</a>
                        <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">新規登録</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if ($mapRoute)
                <x-responsive-nav-link :href="route($mapRoute)" :active="request()->routeIs($mapRoute)">
                    Map
                </x-responsive-nav-link>
            @endif

            @auth
                @if ($dmRoute)
                    <x-responsive-nav-link :href="route($dmRoute)" :active="request()->routeIs('dm.*')">
                        DM
                    </x-responsive-nav-link>
                @endif
            @else
                <x-responsive-nav-link :href="route('login')" :active="false">
                    DM（ログイン）
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <a href="{{ route('login') }}" class="block py-2 text-sm text-gray-700">ログイン</a>
                    <a href="{{ route('register') }}" class="block py-2 text-sm text-gray-700">新規登録</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

