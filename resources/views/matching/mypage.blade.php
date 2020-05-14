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
        <div class="media">
          <a href="#" class="mr-3">
            <img src="{{ Auth::user()->user_image }}" alt="メディアの画像">
          </a>
          <div class="media-body">
            <h5 class="mt-0">マイページ</h5>
            <p>ユーザー名:{{ Auth::user()->name }}</p>
            <p>年齢:{{ Auth::user()->age }}</p>
            <p>性別:{{ Auth::user()->sex }}</p>
            @foreach($user_game_account as $game_account)
              <p>ゲームアカウント:ゲーム機  {{ $game_account->game_hard }}  アカウント  {{ $game_account->account }}</p>
            @endforeach
            <p>SNS:{{ Auth::user()->sns }}</p>
            <p>URL:{{ Auth::user()->url }}</p>
            <p>【プロフィール】</p>
            <p>{{ Auth::user()->profile }}</p>
          </div>
        </div>
        <div>
          <a href="{{ route('edit_mypage') }}" class="btn btn-primary">編集する</a>
        </div>
      </div>
    </form>
@endsection
