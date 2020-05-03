@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">ゲームを見つける</a></li>
    <li class="active"><a href="{{ route('now_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('chat') }}">ユーザーチャット</a></li>
@endsection

@section('content')
  <div class="container">
    <h3>{{ $users[0]->community_name }}</3>
      <br>
        <br>
      </div>

    <div class="container">
        @for ($i = 0; $i < count($users); $i++)
          @if($i == 0 or $i % 4 == 0)
            <div class="row row-cols-1 row-cols-md-3">
          @endif
              <div class="col mb-4">
                <div class="card h-100">
                  <img src="{{ asset('assets/img/user_noimage.png') }}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-title">{{$users[$i]->name}}</p>
                    <p class="card-text">ゲームハード:{{$users[$i]->interface}}</p>
                    <p class="card-text">ボイスチャット:{{$users[$i]->voicechat}}</p>
                    <p class="card-text">サーバ:{{$users[$i]->serve}}</p>
                    <p class="card-text">ランク:{{$users[$i]->rank}}</p>
                    <p class="card-text"><small class="text-muted">最終更新3分前</small></p>
                  </div>
                </div>
              </div>
          @if($i != 0 and $i % 4 == 0)
          </div>
        @endif
      @endfor
    </div>

    <div class="mx-auto" style="width: 200px;">
  {{ $users->links() }}
</div>
@endsection
