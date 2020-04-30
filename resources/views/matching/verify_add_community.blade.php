@extends('layouts.matching')

@section('headers')
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
@endsection


@section('content')
    <nav class="navbar navbar-default navbar-expand-lg" role="navigation">
      <a class="navbar-brand" href="{{ url('/')}}">Matching Gamers 🎮</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-01"></button>
      <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav mr-auto">
          <li><a href="{{ route('matching_community') }}">ゲームを見つける</a></li>
          <li><a href="{{ route('now_community') }}">コミュニティ</a></li>
          <li class="active"><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
          <li><a href="{{ route('chat') }}">ユーザーチャット</a></li>
        </ul>
          <a href="{{ route('mypage') }}">{{Auth::user()->name}}</a>
      </div>
    </nav>

        <div class="container">
          <div class="media">
            <a href="#" class="mr-3">
              <img src="{{ asset('assets/img/user_noimage.png') }}" alt="メディアの画像">
            </a>
            <div class="media-body">
              <h5 class="mt-0">コミュニティ名</h5>
              <p class="mt-0">コミュニティを作成しました。</p>
              <div>
                <a href="{{ route('matching.game') }}" class="btn btn-primary">コミュニティ画面</a>
              </div>
            </div>
          </div>
        </div>
@endsection
