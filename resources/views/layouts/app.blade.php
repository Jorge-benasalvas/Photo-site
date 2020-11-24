<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/proyecto_album/public/image/photosite.png" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Photo-site</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}"></script>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('sass/app.scss') }}" rel="stylesheet">
    
</head>

<body style="background:white; padding-top:0; height:100%">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light  " style="background-color: #1D1D1F">
            <a class="navbar-brand" href="{{ url('/') }}" style="color: white; height:75px;width:75px ">
                <img src="/proyecto_album/public/image/photosite.png" style="height:100%; width:100%" alt="Photo-site">
            </a>

            <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('login') }}" style="color: white">Iniciar sesión</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" style="color: white">Registrarse</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link" style="color: white;">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('image.create')}}" class="nav-link" style="color: white">Subir imagen</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('user.index')}}" class="nav-link" style="color: white">Gente</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('like')}}" class="nav-link" style="color: white">Favoritos</a>
                    </li>
                    <li>
                        &nbsp;
                    </li>
                    <li>
                        <div style="width: 40px; border-radius: 900px; overflow: hidden; height: 40px">
                            @if(Auth::user()->image)
                            <img src="{{route('user.avatar',['filename'=>Auth::user()->image])}}" style="width: 100%; height: 100%">

                            @endif
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('profile',['id'=>Auth::user()->id])}}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg> Mi perfil</a>
                            <a class="dropdown-item" href="{{ route('configuracion') }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                </svg> Configuracion</a>
                            <a class="dropdown-item" href="{{ route('password') }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-key-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg> Cambiar contraseña</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z" />
                                    <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z" />
                                </svg>
                                Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>


                        </div>
                    </li>
                </ul>



                <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('user.index')}}" id="buscador">
                    <input class="form-control mr-sm-2" type="search" id="search" class="form-control" placeholder="Buscar">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                        </svg></button>
                </form>
                @endguest
            </div>
        </nav>
    </div>


    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>

</html>