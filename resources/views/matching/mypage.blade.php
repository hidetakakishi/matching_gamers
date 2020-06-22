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
    <form method="GET">
      <div class="container mini-container">
        <div class="card  flex-center non-border">
          <img src="{{ Auth::user()->user_image }}" class="radius margin-bottom" alt="カードの画像">
          @if(Auth::user()->name)
            <h4 class="mergin-bottom">{{ Auth::user()->name }}</h4>
          @else
            <h4 class="mergin-bottom">未入力</h4>
          @endif
          <br>
          <br>
          <table class="table table-responsive-sm">
            @if(Auth::user()->age)
              <tr><td><small class="text-muted">年齢</small></td><td>{{ Auth::user()->age }}</td><td></td></tr>
            @else
              <tr><td><small class="text-muted">年齢</small></td><td>未入力</td><td></td></tr>
            @endif
            @if(Auth::user()->sex)
              <tr><td><small class="text-muted">性別</small></td><td>{{ Auth::user()->sex }}</td><td></td></tr>
            @else
              <tr><td><small class="text-muted">性別</small></td><td>未入力</td><td></td></tr>
            @endif
            @if(Auth::user()->sns)
              <tr><td><small class="text-muted">SNS</small></td><td>{{ Auth::user()->sns }}</td><td></td></tr>
            @else
              <tr><td><small class="text-muted">SNS</small></td><td>未入力</td><td></td></tr>
            @endif
            @if(Auth::user()->url)
              <tr><td><small class="text-muted">URL</small></td><td>{{ Auth::user()->url }}</td><td></td></tr>
            @else
              <tr><td><small class="text-muted">URL</small></td><td>未入力</td><td></td></tr>
            @endif
            @foreach($user_game_account as $game_account)
                <tr><td><small class="text-muted">ゲームアカウント{{ $loop->iteration }}</small></td><td>{{ $game_account->game_hard }}</td><td>{{ $game_account->account }}</td></tr>
            @endforeach
            <tr><td><small class="text-muted">プロフィール</small></td><td></td><td></td></tr>
          </table>
            @if(Auth::user()->profile)
              <div class="col margin-bottom">
                <div>{{ Auth::user()->profile }}</div>
              </div>
            @else
              <div class="col  margin-bottom">
                <div>未入力</div>
              </div>
            @endif
        </div>
        <a href="{{ route('edit_mypage') }}" class="btn btn-primary margin-bottom">編集する</a>
        <div class="right">
          <small class="text-muted">※このページはフレンドのみ閲覧できます。</small>
        </div>
      </div>
    </form>
@endsection
