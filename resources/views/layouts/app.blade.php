<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/form.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/estilos.css">
</head>
<body class="bg-paralex">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-yellow shadow-sm nav-style">
        <div class="container">
            <a href="{{ url('/') }}">
                <div class="logo-empresa logo-navbar">
                    <img src="/img/Logo-empresa.png"/>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon icon-nav"></span>
            </button>

            <div class="collapse navbar-collapse margin-left-100 text-center" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @if(Auth::user())
                    @if(Auth::user()->cargo === 'Administrador')
                        <ul class="navbar-nav mr-auto">
                            <li>
                                <a class="nav-link nav-link-color display-inline-flex" href="/perfil"><ion-icon name="home-outline"></ion-icon><span class="padding-left-10">Perfil</span></a>
                            </li>
                            <li>
                                <a class="nav-link nav-link-color display-inline-flex" href="/home"><ion-icon name="people-outline"></ion-icon><span class="padding-left-10">Usuarios</span></a>
                            </li>
                            <li>
                                <a class="nav-link nav-link-color display-inline-flex" href="/producto"><ion-icon name="cube-outline"></ion-icon><span class="padding-left-10">Producto</span></a>
                            </li>
                            <li>
                                <a class="nav-link nav-link-color display-inline-flex" href="/facturas"><ion-icon name="receipt-outline"></ion-icon><span class="padding-left-10">Factura | Boletas</span></a>
                            </li>
                            <li>
                                <a class="nav-link nav-link-color display-inline-flex" href="/entradas"><ion-icon name="cloud-upload-outline"></ion-icon><span class="padding-left-10">Entradas</span></a>
                            </li>
                            <li>
                                <a class="nav-link nav-link-color display-inline-flex" href="/salidas"><ion-icon name="cloud-download-outline"></ion-icon><span class="padding-left-10">Salidas</span></a>
                            </li>
                            <li>
                                <a class="nav-link nav-link-color display-inline-flex" href="/inventario"><ion-icon name="layers-outline"></ion-icon><span class="padding-left-10">Inventario</span></a>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav mr-auto">
                            <li>
                                <a class="nav-link nav-link-color" href="/perfil">Perfil</a>
                            </li>
                            <li>
                                <a class="nav-link nav-link-color" href="/facturas">Factura/Boletas</a>
                            </li>
                            <li>
                                <a class="nav-link nav-link-color" href="/salidas">Salidas</a>
                            </li>
                            <li>
                                <a class="nav-link nav-link-color" href="/inventario">Inventario</a>
                            </li>
                        </ul>
                    @endif
            @endif
            <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link nav-link-color" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link nav-link-color" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle nav-link-color" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right nav-menu" aria-labelledby="navbarDropdown">
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
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
