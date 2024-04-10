<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @livewireStyles

    <style>
        .cover-container {
            max-width: 42em;
        }

        .nav-masthead .nav-link {
            border-bottom: .25rem solid transparent;
        }

        .nav-masthead .nav-link:hover,
        .nav-masthead .nav-link:focus {
            border-bottom-color: rgba(17, 0, 255, 0.25);
        }

        .nav-masthead .nav-link+.nav-link {
            margin-left: 1rem;
        }


        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>
</head>

<body class="d-flex text-center">
    <div class="container d-flex p-3 mx-auto flex-column">
        <header class="mb-5">
            <div>
                <a href="{{ route('/') }}">
                    <h3 class="float-md-start mb-0">Mi tienda</h3>
                </a>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    @auth
                        {{-- <a class="nav-link fw-bold py-1 px-0" href="#">Perfil</a> --}}
                        <a class="nav-link fw-bold py-1 px-0" href="{{ route('usuarios') }}">Usuarios</a>
                        <a class="nav-link fw-bold py-1 px-0" href="{{ route('clientes') }}">Clientes</a>
                        <a class="nav-link fw-bold py-1 px-0" href="{{ route('almacen') }}">Almacen</a>
                        <a class="nav-link fw-bold py-1 px-0" href="{{ route('compras') }}">Compra y Venta</a>
                        <a class="nav-link fw-bold py-1 px-0 text-danger" href="{{ route('logout') }}">Salir</a>
                    @else
                        <a class="nav-link fw-bold py-1 px-0 text-dark @if (Route::currentRouteName() == 'login') active @endif"
                            href="{{ route('login') }}">Ingresar</a>
                        <a class="nav-link fw-bold py-1 px-0 text-dark @if (Route::currentRouteName() == 'register') active @endif"
                            href="{{ route('register') }}">Registro</a>
                    @endauth
                </nav>
            </div>
        </header>

        <div class="px-3">
            <div class="row justify-content-center">
               

                @yield('content')
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @livewireScripts
    <x-livewire-alert::scripts />
    <x-livewire-alert::flash />
    @stack('scripts')
</body>

</html>
