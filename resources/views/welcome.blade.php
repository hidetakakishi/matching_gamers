  @extends('layouts.matching')

  <!-- Styles -->
  <style>
      html, body {
          background-color: #fff;
          font-weight: 200;
          height: 100vh;
          margin: 0;
      }

      .full-height {
          height: 100vh;
      }

      .flex-center {
          align-items: center;
          display: flex;
          justify-content: center;
      }

      .position-ref {
          position: relative;
      }

      .top-right {
          position: absolute;
          right: 10px;
          top: 18px;
      }

      .content {
          text-align: center;
      }

      .title {
          font-size: 84px;
      }

      .links > a {
          padding: 0 25px;
          font-size: 13px;
          font-weight: 600;
          letter-spacing: .1rem;
          text-decoration: none;
          text-transform: uppercase;
      }

      .content-links > a {
        padding: 0 25px;
        font-size: 13px;
        font-weight: 50;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
      }

      .m-b-md {
          margin-bottom: 0px;
      }
  </style>
  <form method="GET">
    <div class="flex-center position-ref full-height">
            <div class="top-right links">
              @if(Auth::check())
                <a href="{{ route('matching_community') }}">{{ Auth::user()->name }}</a>
              @else
                <a href="/login">ログイン</a>
                <a href="register">アカウント作成</a>
              @endif
            </div>
        <div class="content">
            <div class="title m-b-md">
                Matching Gamers 🎮
            </div>
            <div class="title m-b-md content-links">
                <a href="{{ route('matching_community') }}">仲間を見つける</a>
            </div>
        </div>
    </div>
  </form>
