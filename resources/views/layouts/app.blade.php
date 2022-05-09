<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name=description content="create tickits tickit add ">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ('Faho') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
{{--    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/app_css.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @guest
        @else
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ __('Faho') }}
                    </a>
                    <div class="navbar-brand d-flex justify-content-evenly">
                        <a class="nav-link" href="{{ route('home') }}" title="Home">
                            <i class="fas fa-home"></i>
                        </a>
                        @if(Auth::user()->status)
                            <a class="nav-link" href="{{ route('All') }}" title="All users">
                                <i class="fas fa-users"></i>
                            </a>
                        @endif

                            <a class="nav-link" href="#"  id="Notification_id"
                               data-bs-toggle="dropdown" aria-expanded="false" title="Notification">
                                <i class="fas fa-bell"><sup class="text-danger">{{count($notification)?count($notification):""}}</sup></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-notification notification" aria-labelledby="Notification_id">
                                @if( count($notification))
                                    @foreach ( $notification as $i =>  $t)
                                        <li class="d-flex flex-column align-items-end p-2">
                                            <a class="text-center dropdown-item text-notification" href="{{ route('Dashboard', ['id'=>"faho_".$t->id."2022"])}}">
                                                {{$t->data}}</a>
                                            <small class="date-notification"> {{$t->created_at->diffForHumans()}}</small> </li>
                                        <hr>
                                    @endforeach
                                @else
                                    <p class="text-center text-notification"> Not notification </p>
                                @endif

                            </ul>
                    </div>

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

{{--                            @if (Route::has('login'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
                                <li>
                                <a class="nav-link" id="nav-link-out" href="{{ route('logout') }}" title="logout"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </li>
                    </ul>
{{--                </div>--}}
            </div>
        </nav>
        @endguest
        <main class="py-2">
            @yield('content')
        </main>
    </div>
</body>
</html>
