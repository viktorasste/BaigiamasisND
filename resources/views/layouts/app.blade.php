<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-4">
    <a class="navbar-brand ms-3" href="{{ url('/') }}">
        Administravimas
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto pe-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin') }}">{{ __('Dashboard') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('stroller') }}">{{ __('Vežimėliai') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reservation') }}">{{ __('Rezervacijos') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users') }}">{{ __('Vartotojai') }}</a>
            </li>

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav me-3">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin') }}">{{ __('Administravimo panelė') }}</a>
                        <a class="dropdown-item"
                           href="{{ route('reservation.list') }}">{{ __('Mano rezervacijos') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
<div id="app">
    <main>
        @yield('content')
    </main>
</div>
</body>
</html>
