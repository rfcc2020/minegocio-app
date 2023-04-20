<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
					@auth()
                    <ul class="navbar-nav mr-auto">
						<!--Nav Bar Hooks - Do not delete!!-->
						<li class="nav-item">
                            <a href="{{ url('/saldos') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Saldos</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/detalleventaproductos') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Detalleventas</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/reportes/resumen') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Reporte</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/ventas') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Ventas</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/detallecompras') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Detallecompras</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/compras') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Compras</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/productos') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Productos</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/proveedores') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Proveedores</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/servicios') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Servicios</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/clientes') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Clientes</a> 
                        </li>
                    </ul>
					@endauth()

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @livewireScripts
    <script type="module">
        const addModal = new bootstrap.Modal('#createDataModal');
        const editModal = new bootstrap.Modal('#updateDataModal');
        window.addEventListener('closeModal', () => {
           addModal.hide();
           editModal.hide();
        })
    </script>
</body>
</html>