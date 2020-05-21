@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li class="active"><a href="{{ route('friend') }}">フレンド</a></li>
@endsection

@section('content')
  <form method="post" action="?">
    @csrf
    <div class="container">
      <div class="card h-500 w-100" style="height: 500px;">
        <div class="card-header">フレンド一覧</div>
          <div class="card-body">
            @foreach($send_friends as $friend)
              <div>
                <p>{{ $friend->name }}</p>
                最終ログイン({{ $friend->last_login_at }})
                <a href="{{ route('userpage',['user_id'=>$friend->id]) }}" class="btn btn-primary">ユーザーページ</a>
              </div>
            @endforeach
            @foreach($post_friends as $friend)
              <div>
                <p>{{ $friend->name }}</p>
                最終ログイン({{ $friend->last_login_at }})
                <a href="{{ route('userpage',['user_id'=>$friend->id]) }}" class="btn btn-primary">ユーザーページ</a>
              </div>
            @endforeach
          </div>
        </div>
      </div>

    <br>

      <div class="container">
        <div class="card h-500 w-100" style="height: 500px;">
          <div class="card-header">フレンド申請</div>
            <div class="card-body">
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

        <div class="container">
          <div class="card h-500 w-100" style="height: 500px;">
            <div class="card-header">申請中</div>
              <div class="card-body">
                @foreach($post_request as $post)
                  <div>{{ $post->name }}
                    <input type="hidden" name="user_id" value="{{ $post->id }}">
                    <button type="submit" class="btn btn-embossed btn-danger" formaction="{{ route('friend.delete') }}">削除</button>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </form>
@endsection
