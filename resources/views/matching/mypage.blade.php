@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('friend') }}">フレンド</a></li>
@endsection

@section('content')
    <form method="GET">
      <div class="container">
        ※このページはフレンドのみ閲覧できます。
        <br><br>
            <div class="card">
              <div class="card-header">マイページ</div>
                <div class="card-body">
                  <div class="media">
                    <a href="#" class="mr-3">
                      <img src="{{ Auth::user()->user_image }}" alt="メディアの画像">
                    </a>
                    <div class="media-body">
                      <table class="table">
                        <thead class="thead-light">
                          <tr><th>ユーザー名</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->name)
                          <tr><th>{{ Auth::user()->name }}</th></tr>
                        @else
                          <tr><th>未入力</th></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>年齢</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->age)
                          <tr><th>{{ Auth::user()->age }}</th></tr>
                        @else
                          <tr><th>未入力</th></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>性別</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->sex)
                          <tr><th>{{ Auth::user()->sex }}</th></tr>
                        @else
                          <tr><th>未入力</th></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>SNS</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->sns)
                          <tr><th>{{ Auth::user()->sns }}</th></tr>
                        @else
                          <tr><th>未入力</th></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>URL</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->url)
                          <tr><th>{{ Auth::user()->url }}</th></tr>
                        @else
                          <tr><th>未入力</th></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>プロフィール</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->profile)
                          <tr><th>{{ Auth::user()->profile }}</th></tr>
                        @else
                          <tr><th>未入力</th></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>ゲームアカウント</th><th></th><th></th></tr>
                        </thead>
                          <tr><th>#</th><th>ゲームハード</th><th>アカウント名</th></tr>
                          @foreach($user_game_account as $game_account)
                              <tr><th>{{ $loop->iteration }}</th><th>{{ $game_account->game_hard }}</th><th>{{  $game_account->account }}</th></tr>
                          @endforeach
                      </table>
                    </div>
                  </div>
                  <div>
                  <a href="{{ route('edit_mypage') }}" class="btn btn-primary">編集する</a>
                </div>
                </div>
            </div>
        </div>
      </form>
@endsection
