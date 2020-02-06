<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Congresos Online</title>
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/jumbotron.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/own.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="header-container container">
                <div class="logo">
                    <div class="logo-text">Congresos Online</div>
                </div>
                <nav class="nav">
                    <ul class="nav-list">
                        <li class="nav-item"><a href="{{ url('/') }}" class="nav-link nav-link_active">Inicio</a></li>
                        <li class="nav-item"><a href="{{ url('/') }}#congress" class="nav-link">Ponencias</a></li>
                        <li class="nav-item"><a href="{{ url('/') }}#speaker" class="nav-link">Ponentes</a></li>
                        @auth
                            <li class="nav-item_profile">
                                <a href="{{ url('user') }}" class="nav-link">
                                    <img src="{{ url('user/file/' . Auth::user()->img) }}"></img>
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <form class="" action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="nav-link nav-link_outline">
                                        {{ __('Logout') }}
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item"><a href="{{ url('login') }}" class="nav-link nav-link_outline">Login</a></li>
                            <li class="nav-item"><a href="{{ url('register') }}" class="nav-link nav-link_outline nav-link_outline_fill">Register</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </header>
        
        @yield('content')
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{ url('assets/js/jquery-3.3.1.slim.min.js') }}"><\/script>')</script>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>
</body>
</html>