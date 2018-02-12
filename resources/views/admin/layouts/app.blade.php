<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @auth
        <meta name="userId" id="userId" content="{{Auth::user()->id}}" />
        @endauth

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <style>
            input.hidden {
                position: absolute;
                left: -9999px;
            }

            #profile-image1 {
                cursor: pointer;

                width: 100px;
                height: 100px;
                border:2px solid #03b1ce ;}
            .tital{ font-size:16px; font-weight:500;}
            .bot-border{ border-bottom:1px #f8f8f8 solid;  margin:5px 0  5px 0}	
        </style>
        @stack('styles')
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            @else


                            <!--
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <span class="glyphicon glyphicon-bell">

                                    </span> <span class="caret"></span>
                                </a>

                                <ul id="notification" class="dropdown-menu">
                                    <li>Teste</li>
                                </ul>

                            </li>
                            -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>

                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="list-group">
                            <span href="#" class="list-group-item active">
                                Admin
                            </span>
                            <a href="/admin/planejamento" class="list-group-item">
                                <i class="fa fa-clipboard"></i> Planejamento
                            </a>
                            <a href="/admin/visitas" class="list-group-item">
                                <i class="fa fa-building"></i> 
                                Visitas
                            </a>
                            <a href="/admin/hotlist" class="list-group-item">
                                <i class="fa fa-fire"></i> Hotlists
                            </a>
                            <a href="/admin/presenca" class="list-group-item">
                                <i class="fa fa-flag-checkered"></i> Presença em Loja
                            </a>
                            <a href="/admin/treinamento" class="list-group-item">
                                <i class="fa fa-book"></i> Treinamento
                            </a>
                            <hr>
                            <a href="/admin/usuarios" class="list-group-item">
                                <i class="fa fa-users"></i> Usuarios
                            </a>
                            <a href="/admin/regioes" class="list-group-item">
                                <i class="fa fa-users"></i> Regiões
                            </a>
                            <a href="/admin/regiao" class="list-group-item">
                                <i class="fa fa-globe"></i> Regiões
                            </a>
                            <a href="/admin/faixa" class="list-group-item">
                                <i class="fa fa-globe"></i> Faixas
                            </a>
                            <a href="/admin/processo" class="list-group-item">
                                <i class="fa fa-globe"></i> Processos
                            </a>
                            
                        </div>        
                    </div>
                    <div class="col-md-9 col-sm-9" id="content">

                        @if(session('status'))
                        <div class="alert alert-success alert-dismissable fadeIn" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('status') }}
                        </div>    
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable fadeIn"role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        @stack('scripts')
    </body>
</html>
