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
                <div class="p-1 flex flex-row items-center">
                    <a href="https://github.com/l3xbcn/liga_futbol" class="text-white p-2 mr-2 no-underline hidden md:block lg:block">Github</a>


                    <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="https://github.com/l3xbcn.png" alt="">
                    <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">Alejandro Gallardo</a>
                    <div id="ProfileDropDown">
                        <ul>
                            <li><a href="#">Mi cuenta</a></li>
                            <li><a href="#">Notificaciones</a></li>
                            <li><hr></li>
                            <li><a href="#">Desconectar</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </header>

        <div class="flex">
            
            <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block" style="display: block;">

                <ul class="list-reset flex flex-col">
                    <li>
                        <a href="{{ request()->getSchemeAndHttpHost() }}/jugador">
                            <i class="fas fa-user"></i>
                            Jugadores
                            <i class="fas fa-angle-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ request()->getSchemeAndHttpHost() }}/equipo">
                            <i class="fas fa-user-friends"></i>
                            Equipos
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ request()->getSchemeAndHttpHost() }}/partido">
                            <i class="fas fa-futbol"></i>
                            Partidos
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ request()->getSchemeAndHttpHost() }}/edicion">
                            <i class="fas fa-calendar-alt"></i>
                            Ediciones
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ request()->getSchemeAndHttpHost() }}/ruta_no_registrada">
                            <i class="fas fa-exclamation-triangle"></i>
                            404 Page
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <hr>
                    <li>
                        <a href="{{ request()->getSchemeAndHttpHost() }}/user">
                            <i class="fas fa-users"></i>
                            Administración
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>

            </aside>            
                
            <main>
                <div class="title">
                    @yield('title')
                </div>
                <div class="content">
                    <a href="{{ request()->getSchemeAndHttpHost() }}/@yield('model')/create"><button class="create float-right">Crear nuevo</button></a>
                    <form action="/@yield('model')" method="get" role="search" class="search">
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
                    @yield('content')
                </div>
            </main>

        </div>

        <footer>
            <p>© Alejandro</p>
        </footer>

    <script src="{{ asset('js/tailwindadmin.js') }}"></script>
    @yield('js')
    </body>

</html>