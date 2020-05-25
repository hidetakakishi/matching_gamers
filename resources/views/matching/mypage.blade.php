@extends('layouts.matching')

@section('headers')
  <style>
    .table th{
        padding: 0.55rem;
    }
  </style>
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
                      <table class="table table-responsive-sm">
                        <thead class="thead-light">
                          <tr><th>ユーザー名</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->name)
                          <tr><td>{{ Auth::user()->name }}</td></tr>
                        @else
                          <tr><td>未入力</td></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>年齢</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->age)
                          <tr><td>{{ Auth::user()->age }}</td></tr>
                        @else
                          <tr><td>未入力</td></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>性別</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->sex)
                          <tr><td>{{ Auth::user()->sex }}</td></tr>
                        @else
                          <tr><td>未入力</td></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>SNS</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->sns)
                          <tr><td>{{ Auth::user()->sns }}</td></tr>
                        @else
                          <tr><td>未入力</td></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>URL</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->url)
                          <tr><td>{{ Auth::user()->url }}</td></tr>
                        @else
                          <tr><td>未入力</td></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>プロフィール</th><th></th><th></th></tr>
                        </thead>
                        @if(Auth::user()->url)
                          <tr><td>{{ Auth::user()->url }}</td></tr>
                        @else
                          <tr><td>未入力</td></tr>
                        @endif
                        <thead class="thead-light">
                          <tr><th>ゲームアカウント</th><th></th><th></th></tr>
                        </thead>
                        <tr><td>No</td><td>インターフェイス</td><td>アカウント</td></tr>
                        @foreach($user_game_account as $game_account)
                            <tr><td>{{ $loop->iteration }}</td><td>{{ $game_account->game_hard }}</td><td>{{  $game_account->account }}</td></tr>
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
