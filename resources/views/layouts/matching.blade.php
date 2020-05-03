<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MatchingGamers</title>

        <!-- Loading Bootstrap -->
        <link href="{{ url('/') }}/dist/css/vendor/bootstrap.min.css" rel="stylesheet">
        <link href="{{ url('/') }}/dist/css/flat-ui.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>
            html, body {
                background-color: #fff;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            img {
              width: 230px;
              height: 230px;
            }


        </style>

        @yield('headers')
    </head>
    <body>
      <div id="app">
        <nav class="navbar navbar-default navbar-expand-lg" role="navigation">
          <a class="navbar-brand" href="{{ url('/')}}">Matching Gamers 🎮</a>
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-01"></button>
          <div class="collapse navbar-collapse" id="navbar-collapse-01">
            <ul class="nav navbar-nav mr-auto">
              @yield('navbar')
            </ul>
            @if(Auth::check())
            <ul class="nav navbar-nav mr-auto">
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('mypage') }}">マイページ</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
              </li>
            </ul>
            @endif
          </div>
        </nav>

        @yield('content')
          @yield('footer_javascript')
      </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</html>
