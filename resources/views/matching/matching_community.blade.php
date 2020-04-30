@extends('layouts.matching')

@section('headers')
<style>
    html, body {
        background-color: #fff;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

</style>
@endsection

@section('content')

    <nav class="navbar navbar-default navbar-expand-lg" role="navigation">
      <a class="navbar-brand" href="{{ url('/')}}">Matching Gamers 🎮</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-01"></button>
      <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav mr-auto">
          <li class="active"><a href="{{ route('matching_community') }}">ゲームを見つける</a></li>
          <li><a href="{{ route('now_community') }}">コミュニティ</a></li>
          <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
          <li><a href="{{ route('chat') }}">ユーザーチャット</a></li>
        </ul>
          <a href="{{ route('mypage') }}">{{Auth::user()->name}}</a>
      </div>
    </nav>

    <form method="get">
      <div class="container">
        @for ($i = 0; $i < count($communitys); $i++)
          @if($i == 0 or $i % 4 == 0)
            <div class="row row-cols-1 row-cols-md-3">
          @endif
            <div class="col mb-4">
              <div class="card h-100">
                <img src="{{ asset('assets/img/game_noimage.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $communitys[$i]->community_name}}</h5>
                  <p class="card-text"></p>
                  <a href="{{ route('verify_community',['community_id'=>$communitys[$i]->id]) }}" class="btn btn-primary">参加する</a>
                </div>
              </div>
            </div>
          @if($i != 0 and $i % 4 == 0)
            </div>
          @endif
        @endfor
      </div>
    </form>



      <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3 py-2">
          <nav aria-label="ページ送り">
            <div class="text-center">
              <div class="pagination pagination-minimal justify-content-center">
                <ul>
                  <li class="previous">
                    <a href="#" class="fui-arrow-left"></a>
                  </li>
                  <li class="pagination-dropdown dropup">
                    <a href="#" data-toggle="dropdown">1</a>
                    <a href="#" data-toggle="dropdown">2</a>
                    <a href="#" data-toggle="dropdown">3</a>
                    <a href="#" data-toggle="dropdown">4</a>
                    <a href="#" data-toggle="dropdown">5</a>
                    <a href="#" data-toggle="dropdown">6</a>
                    <a href="#" data-toggle="dropdown">7</a>
                    <a href="#" data-toggle="dropdown">8</a>
                    <a href="#" data-toggle="dropdown">9</a>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="#">10-20</a>
                      </li>
                    </ul>
                  </li>
                  <li class="next">
                    <a href="#" class="fui-arrow-right"></a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
@endsection
