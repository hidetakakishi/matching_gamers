@extends('layouts.matching')

@section('header')
@endsection

@section('navbar')
    <li><a href="{{ route('matching_community') }}">ゲームを見つける</a></li>
    <li class="active"><a href="{{ route('now_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('friend') }}">フレンド</a></li>
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
                  <img src="{{ $users[$i]->user_image }}" class="card-img-top" alt="...">
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

        <div class="card h-500 w-100" style="height: 500px;">
          <div class="card-header">コミュニティチャット</div>
            <div class="card-body">
              @foreach( $chat as $comment)
                @if($comment->id == Auth::user()->id)
                  <div style="text-align: right;">
                    <p>{{ $comment->name}} : {{$comment->created_at}}</p>
                    <p>{{ $comment->comment }}</p>
                  </div>
                @else
                  <div>
                    <p>{{ $comment->name}} : {{$comment->created_at}}</p>
                    <p>{{ $comment->comment }}</p>
                  </div>
                @endif
              @endforeach
            </div>
          </div>

        <br>
        <form method="POST" action="{{ route('community_chat') }}">
          @csrf
          <input type="hidden" name="community_id" value="{{ $users[0]->id }}">
            <div class="input-group mb-3">
              <input type="text" name="comment" class="form-control" placeholder="チャットを送信する" aria-label="..." aria-describedby="button-addon2">
            <div class="input-group-append">
              <button type="submit" id="button-addon2" class="btn btn-outline-secondary">ボタン</button>
            </div>
          </div>
        </form>

    <div class="mx-auto" style="width: 200px;">
  {{ $users->links() }}
</div>

@endsection
