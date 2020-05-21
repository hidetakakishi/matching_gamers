<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MatchingGamers</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Loading Bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        img {
          width: 200px;
          height: 200px;
        }
        body {
          background-color: white;
        }
        .py-4 {
          background-color: white;
        }
        .active {
          border-bottom: solid transparent;
          border-bottom-color: black;
        }
        .fade {
            animation-name: fadein;
            animation-duration: 1s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }
        @keyframes fadein {
          0% {
              opacity: 0;
              transform: translateY(20px);
          }
          100% {
              opacity: 1;
              transform: translateY(0);
          }
        }

        .message-fade {
            animation-name: messsage-fadein;
            animation-duration: 1s;
            animation-iteration-count: 1;
        }
        @keyframes messsage-fadein {
          0% {
              opacity: 0;
          }
          100% {
              opacity: 1;
          }
        }

        .alert{
          text-align: center;
        }
    </style>

    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    @yield('headers')
</head>
    <body>
      <div id="app">
        <div class="container">
          <nav class="navbar navbar-expand-md navbar-light bg-white">
                  <a class="navbar-brand" href="{{ url('/') }}">
                      Matching Gamers 🎮
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                      <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <!-- Left Side Of Navbar -->
                      <ul class="navbar-nav nav-masthead mr-auto">
                        <li class="nav-item" ><a class="nav-link" href="{{ route('matching_community') }}">コミュニティに参加する</a></li>
                        <li class="nav-item" ><a class="nav-link" href="{{ route('add_community') }}">コミュニティを作成する</a></li>
                        <li class="nav-item" ><a class="nav-link" href="{{ route('now_community') }}">マイコミュニティ</a></li>
                        <li class="nav-item" ><a class="nav-link" href="{{ route('friend') }}">フレンド</a></li>
                        <li class="nav-item" ><a class="nav-link" href="{{ route('mypage') }}">マイページ</a></li>

                      </ul>

                      <!-- Right Side Of Navbar -->
                      <ul class="navbar-nav ml-auto">
                          <!-- Authentication Links -->
                          @guest
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                              </li>
                              @if (Route::has('register'))
                                  <li class="nav-item">
                                      <a class="nav-link" href="{{ route('register') }}">{{ __('アカウント作成') }}</a>
                                  </li>
                              @endif
                          @else

                              <li class="nav-item dropdown">
                                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                      {{ Auth::user()->name }} <span class="caret"></span>
                                  </a>

                                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                          ログアウト
                                      </a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                                  </div>
                              </li>
                          @endguest
                      </ul>
                  </div>
                </nav>
            </div>
        <main class="py-4">
          @if (session('flash_message'))
          <div class="alert alert-info message-fade">
              {{ session('flash_message') }}
          </div>
          @endif

          @yield('content')
        </main>
      </div>
      <script>
      var url = window.location;
         $('.nav-item a[href="'+url+'"]').addClass('active');
      </script>
      @yield('footer_javascript')
    </body>
</html>
