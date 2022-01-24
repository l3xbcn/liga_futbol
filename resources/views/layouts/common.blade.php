<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @yield('css')

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>

        <header>            
            <div class="header-logo" style="background-image: url({{ asset('img/futbol.jpg') }}); height: 120px">
                <span>LaLiga</span>
            </div>

            <div class="topbar">
                <div class="p-1 mx-3 inline-flex items-center">
                    <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()"></i>
                </div>
                <div class="p-1 inline-flex items-centers">
                    @canany('view', 'edit', 'admin')
                    <a onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full fas fa-user text-white text-lg"></a>
                    <div id="ProfileDropDown">
                        <ul>
                            <li>
                                {{ Auth::user()->name }}
                                <hr/>
                            </li>

                            <li>
                                <a href="/dashboard">Mi cuenta</a>
                            </li>
                            
                            <hr/>
                            
                            <li>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Desconectar</a>
                                </form>
                            </li>

                        </ul>
                    </div>
                    @endcan
                    @canany('view', 'edit', 'admin')
                    @else
                    <span class="text-white text-lg pr-2">
                    <a href="/login">Login</a>
                    |&nbsp;
                    <a href="/register">Registro</a>
                    </span>
                    @endcan
                    <span class="text-white text-lg">
                        |&nbsp;
                        <a href="https://github.com/l3xbcn/liga_futbol">Repositorio en Github</a>
                    </span>
                </div>
            </div>

        </header>

        <div class="flex">
            
            <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block" style="display: block;">

                <ul class="list-reset flex flex-col">
                    <li>
                        <a href="{{ route('player.index') }}">
                            <i class="fas fa-user"></i>
                            Jugadores
                            <i class="fas fa-angle-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('team.index') }}">
                            <i class="fas fa-user-friends"></i>
                            Equipos
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    @can('regActions')
                    <li>
                        <a href="{{ route('game.index') }}">
                            <i class="fas fa-futbol"></i>
                            Partidos
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('edition.index') }}">
                            <i class="fas fa-calendar-alt"></i>
                            Ediciones
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a href="{{ route('404') }}">
                            <i class="fas fa-exclamation-triangle"></i>
                            404 Page
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    @can('admin')
                    <hr>
                    <li>
                        <a href="{{ route('user.index') }}">
                            <i class="fas fa-users"></i>
                            Administración
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    @endcan
                </ul>

            </aside>            
                
            <main>
                <div class="title">
                    @yield('title')
                </div>
                <div class="content">
                    @if (str_contains(Route::current()->getName(),'.index'))
                    @can('edit')
                    <a href="{{ URL::current() }}/create"><button class="create float-right">Crear nuevo</button></a>
                    @endcan
                    <form action="{{ URL::current() }}" method="get" role="search" class="search">
                        {{ csrf_field() }}
                            <div class="flex">
                                <div>
                                    <input type="text" class="form-control" name="q" placeholder="Buscar">
                                </div>
                                <div>
                                        <button type="submit" class="btn btn-default fas fa-search"></button>
                                </div>
                                <div>
                                        <button type="reset" class="btn btn-default fas fa-eraser" onclick="submit()"></button>
                                </div>
                            </div>
                    </form>
                    @endif
                    @yield('content')
                </div>
            </main>

        </div>

        <footer>
            <p>© Alejandro</p>
        </footer>

        <script src="{{ asset('js/tailwindadmin.js') }}"></script>

    </body>

</html>
