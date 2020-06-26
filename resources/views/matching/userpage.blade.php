@extends('layouts.matching')

@section('headers')
  <style>
    .table th{
      padding: 0.55rem;
    }
    table{
      margin-bottom: 0rem;
    }
    .table{
      margin-bottom: 0rem;
    }
    img{
      width: 150px;
      height: 150px;
    }
  </style>
@endsection

@section('content')
  <div class="container mini-container page-fade">
    <div class="card  flex-center non-border">
      <img src="{{ $user->user_image }}" class="radius margin-bottom" alt="カードの画像">
      @if($user->name)
        <h4 class="mergin-bottom">{{ $user->name }}</h4>
      @else
        <h4 class="mergin-bottom">未入力</h4>
      @endif
      <br>
      <br>
      <table class="table table-responsive-sm">
        @if($user->age)
          <tr><td><small class="text-muted">年齢</small></td><td>{{ $user->age }}</td><td></td></tr>
        @else
          <tr><td><small class="text-muted">年齢</small></td><td>未入力</td><td></td></tr>
        @endif
        @if($user->sex)
          <tr><td><small class="text-muted">性別</small></td><td>{{ $user->sex }}</td><td></td></tr>
        @else
          <tr><td><small class="text-muted">性別</small></td><td>未入力</td><td></td></tr>
        @endif
        @if($user->sns)
          <tr><td><small class="text-muted">SNS</small></td><td>{{ $user->sns }}</td><td></td></tr>
        @else
          <tr><td><small class="text-muted">SNS</small></td><td>未入力</td><td></td></tr>
        @endif
        @if($user->url)
          <tr><td><small class="text-muted">URL</small></td><td>{{ $user->url }}</td><td></td></tr>
        @else
          <tr><td><small class="text-muted">URL</small></td><td>未入力</td><td></td></tr>
        @endif
        @foreach($user_game_account as $game_account)
            <tr><td><small class="text-muted">ゲームアカウント{{ $loop->iteration }}</small></td><td>{{ $game_account->game_hard }}</td><td>{{ $game_account->account }}</td></tr>
        @endforeach
        <tr><td><small class="text-muted">プロフィール</small></td><td></td><td></td></tr>
      </table>
        @if($user->profile)
          <div class="col margin-bottom">
            <div>{{ $user->profile }}</div>
          </div>
        @else
          <div class="col  margin-bottom">
            <div>未入力</div>
          </div>
        @endif
    </div>
    <form method="post" action="{{ route('friend.delete') }}">
      @csrf
      <input type="hidden" name="id" value="{{ $user->id }}">
      <button type="submit" class="btn btn-embossed btn-danger">フレンドから削除</button>
    </form>
  </div>
  <br>
  <br>
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
