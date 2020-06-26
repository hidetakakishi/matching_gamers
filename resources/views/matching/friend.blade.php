@extends('layouts.matching')

@section('content')
  <form method="post" action="?">
    @csrf
    <div class="container page-fade">
      <div class="card h-500 w-100" style="height: 500px;">
        <div class="card-header white">フレンド一覧</div>
          <div class="card-body scroll">
            @foreach($send_friends as $friend)
              <div>
                <p><a href="{{ route('userpage',['user_id'=>$friend->id]) }}" class="">{{ $friend->name }}</a> : 最終ログイン({{ $friend->last_login_at }})</p>
              </div>
            @endforeach
            @foreach($post_friends as $friend)
              <div>
                <p><a href="{{ route('userpage',['user_id'=>$friend->id]) }}" class="">{{ $friend->name }}</a> : 最終ログイン({{ $friend->last_login_at }})</p>
              </div>
            @endforeach
          </div>
        </div>
      </div>

    <br>

      <div class="container page-fade">
        <div class="card h-500 w-100" style="height: 250px;">
          <div class="card-header white">フレンド申請</div>
            <div class="card-body scroll">
              @foreach($friend_request as $request)
                <div>{{ $request->name }}
                  <input type="hidden" name="user_id" value="{{ $request->id }}">
                    <button type="submit" class="btn btn-embossed btn-primary" formaction="{{ route('friend.check') }}">確認</button>
                    <button type="submit" class="btn btn-embossed btn-danger" formaction="{{ route('friend.delete') }}">削除</button>
                </div>
              @endforeach
            </div>
          </div>
        </div>

      <br>

        <div class="container page-fade">
          <div class="card h-500 w-100" style="height: 250px;">
            <div class="card-header white">申請中</div>
              <div class="card-body scroll">
                @foreach($post_request as $post)
                  <div>{{ $post->name }}
                    <input type="hidden" name="id" value="{{ $post->id }}">
                    <button type="submit" class="btn btn-embossed btn-danger" formaction="{{ route('friend.delete') }}">削除</button>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </form>
@endsection
