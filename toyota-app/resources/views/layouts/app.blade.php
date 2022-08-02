<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TOYOTA APP</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src=" {{ asset('js/jsQR.js') }} "></script>


    <!-- Style -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    BPO GLOBAL SERVICES
            </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <a id="navbarDropdown" class="nav-link" href="{{ route('home') }}">
                                Lector
                            </a>
                        </li>
                        @if(@Auth::user()->hasRole('admin'))
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link" href=" {{ route('reportes') }} ">
                                    Reportes
                                </a>
                            </li>
                            <a id="navbarDropdown" class="nav-link" href=" {{ route('index.admin') }}">
                                Crear usuario
                            </a>
                            @endif
                            @if(@Auth::user()->hasRole('rol2'))
                            <a id="navbarDropdown" class="nav-link" href="{{ route('reportes') }}">
                                Reportes
                            </a>
                            @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Cerrar sesión
                        </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


            @if (Auth::user())
                <h1 class="text-center mt-3">{{ Auth::user()->name }}</h1>
            @endif


        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
