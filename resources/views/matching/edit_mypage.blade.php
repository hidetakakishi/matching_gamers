@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">ゲームを見つける</a></li>
    <li><a href="{{ route('now_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('chat') }}">ユーザーチャット</a></li>
@endsection

@section('content')
    <form method="POST" action="{{ route('update_mypage') }}">
      @csrf
      <div class="container">
        <div class="media">
          <a href="#" class="mr-3">
            <img src="{{ asset('assets/img/user_noimage.png') }}" alt="メディアの画像">
          </a>
          <div class="media-body">
            <h5 class="mt-0">ユーザー情報</h5>
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">ユーザー名</span>
              </div>
              <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">性別</span>
              </div>
              <input type="text" class="form-control" name="sex" value="{{ Auth::user()->sex }}" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">年齢</span>
              </div>
              <input type="text" class="form-control" name="age" value="{{ Auth::user()->age }}" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">自己紹介</span>
              </div>
              <input type="text" class="form-control" name="profile" value="{{ Auth::user()->profile }}" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div>
              <button type="submit" class="btn btn-embossed btn-primary">
                保存
              </button>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <div class="container">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">アップロード</span>
          </div>
          <div class="custom-file">
            <input type="file" id="inputGroupFile01" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01" data-browse="">ファイル選択...</label>
          </div>
        </div>
      </div>
    </form>
@endsection
