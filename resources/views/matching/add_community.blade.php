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
          <li><a href="{{ route('matching.game') }}">ゲームを見つける</a></li>
          <li><a href="{{ route('matching.user') }}">友達を見つける</a></li>
          <li class="active"><a href="{{ route('matching.community') }}">コミュニティを作成する</a></li>
          <li><a href="{{ route('matching.chat') }}">ユーザーチャット</a></li>
          <li><a href="{{ route('matching.mypage') }}">マイページ</a></li>
        </ul>
        <form class="navbar-form form-inline my-2 my-lg-0" action="#" role="search">
          <div class="form-group">
            <div class="input-group">
              <input class="form-control" id="navbarInput-01" type="search" placeholder="Search">
              <span class="input-group-btn">
                <button type="submit" class="btn"><span class="fui-search"></span></button>
              </span>
            </div>
          </div>
        </form>
      </div>
    </nav>

    <div class="container">
      <div class="media">
        <a href="#" class="mr-3">
          <img src="{{ asset('assets/img/user_noimage.png') }}" alt="メディアの画像">
        </a>
        <div class="media-body">
          <h5 class="mt-0">コミュニティ作成</h5>
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">コミュニティ名</span>
            </div>
            <input type="text" class="form-control" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupFileAddon01">アップロード</span>
            </div>
            <div class="custom-file">
              <input type="file" id="inputGroupFile01" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
              <label class="custom-file-label" for="inputGroupFile01" data-browse="">ファイル選択...</label>
            </div>
          </div>

          <div>
            <a href="#" class="btn btn-primary">作成する</a>
          </div>
        </div>
      </div>
    </div>
@endsection
