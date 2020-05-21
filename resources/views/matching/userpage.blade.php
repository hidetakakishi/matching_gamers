@extends('layouts.matching')

@section('content')
    <form method="GET">
      <div class="container">
        <div class="card">
          <div class="card-header">フレンド情報</div>
            <div class="card-body">
              <div class="media">
                <a href="#" class="mr-3">
                  <img src="{{ $user->user_image }}" alt="メディアの画像">
                </a>
                <div class="media-body">
                  <table class="table">
                    <thead class="thead-light">
                      <tr><th>ユーザー名</th><th></th><th></th></tr>
                    </thead>
                    @if($user->name)
                      <tr><th>{{ $user->name }}</th></tr>
                    @else
                      <tr><th>未入力</th></tr>
                    @endif
                    <thead class="thead-light">
                      <tr><th>年齢</th><th></th><th></th></tr>
                    </thead>
                    @if($user->age)
                      <tr><th>{{ $user->age }}</th></tr>
                    @else
                      <tr><th>未入力</th></tr>
                    @endif
                    <thead class="thead-light">
                      <tr><th>性別</th><th></th><th></th></tr>
                    </thead>
                    @if($user->sex)
                      <tr><th>{{ $user->sex }}</th></tr>
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
                    <thead class="thead-light">
                      <tr><th>SNS</th><th></th><th></th></tr>
                    </thead>
                    @if($user->sns)
                      <tr><th>{{ $user->sns }}</th></tr>
                    @else
                      <tr><th>未入力</th></tr>
                    @endif
                    <thead class="thead-light">
                      <tr><th>URL</th><th></th><th></th></tr>
                    </thead>
                    @if($user->url)
                      <tr><th>{{ $user->url }}</th></tr>
                    @else
                      <tr><th>未入力</th></tr>
                    @endif
                    <thead class="thead-light">
                      <tr><th>プロフィール</th><th></th><th></th></tr>
                    </thead>
                    @if($user->profile)
                      <tr><th>{{ $user->profile }}</th></tr>
                    @else
                      <tr><th>未入力</th></tr>
                    @endif
                  </table>
                </div>
              </div>
              <form method="post" action="{{ route('friend.delete') }}">
                @csrf
                <button type="submit" class="btn btn-embossed btn-danger">フレンドから削除</button>
              </form>
            </div>
          </div>
       </div>
    </form>
        <br>
        <br>

      <div class="container">
        <h3>参加中のコミュニティ</3>
          <br><br>
          @foreach($user_community as $community)
          @if($loop->index != 0 and $loop->index % 3 == 0)
            </div>
          @endif
          @if($loop->index == 0 or $loop->index % 3 == 0)
            <div class="row row-cols-1 row-cols-md-3">
          @endif
          <div class="col mb-4">
            <div class="card" style="height: 400px;">
              <img src="{{ $community->community_image }}" class="card-img-top" alt="コミュニティイメージ">
                <div class="card-body">
                  <p class="card-title">{{$community->community_name}}</p>
                  <p class="card-text">参加者:{{$community->community_members}}人</p>
                  @unless(in_array($community->id,$my_communitys))
                    <a href="{{ route('verify_community',['community_id'=>$community->id]) }}" class="btn btn-primary">参加する</a>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
@endsection
