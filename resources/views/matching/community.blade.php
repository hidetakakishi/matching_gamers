@extends('layouts.matching')

@section('headers')
  <style>
    .community-image{
      width: 300px;
    }
    .font-big {
      font-size: 16px;
    }
  </style>
@endsection

@section('content')
  <div class="container" id="ajaxreload">
    <div class="media fade">
      <a href="#" class="mr-3">
        <img class="community-image" src="{{ $community->community_image }}" alt="メディアの画像">
      </a>
      <div class="media-body text-center">
        <br>
        <br>
        <br>
        <h2 class="font-weight-normal">{{ $community->community_name }}</2>
      </div>
    </div>
  </div>
  <br><br>

      <div class="container">
        <div class="card fade">
          <div class="card-header">コミュニティメンバー</div>
            <div class="card-body">
              @foreach ($users as $user)
                @if($loop->index != 0 and $loop->index % 3 == 0)
                  </div>
                @endif
                @if($loop->index == 0 or $loop->index % 3 == 0)
                  <div class="row row-cols-1 row-cols-md-3">
                @endif
                  <div class="col mb-4">
                    <div class="card h-100">
                      <img src="{{ $user->user_image }}" class="card-img-top" alt="...">
                      <div class="card-body">
                        <p class="card-title">{{ $user->name }}</p>
                        <p class="card-text">ゲームハード:{{ $user->interface }}</p>
                        <p class="card-text">ボイスチャット:{{ $user->voicechat }}</p>
                        <p class="card-text">サーバ:{{ $user->serve }}</p>
                        <p class="card-text">ランク:{{ $user->rank }}</p>
                        <form method="post" action="{{ route('community_add_friend') }}">
                          @csrf
                          <input type="hidden" name="send_user_id" value="{{ $user->id }}">
                          @unless($user->id == Auth::user()->id)
                            @if(in_array($user->id,$my_friends))
                              <a href="{{ route('userpage',['user_id'=>$user->id]) }}" class="btn btn-primary">ユーザーページ</a>
                            @else
                              <button type="submit" class="btn btn-embossed btn-primary">
                                フレンドに追加
                              </button>
                            @endif
                          @endunless
                        </form>
                      </div>
                    </div>
                  </div>
              @endforeach
            </div>
          </div>
        </div>
    <br>
    <br>

    <div class="mx-auto" style="width: 200px;">
      {{ $users->links() }}
    </div>

        <div class="card h-500 w-100 fade" style="height: 500px;">
          <div class="card-header">コミュニティチャット</div>
            <div class="card-body scroll">
              @foreach( $chat as $comment)
                @if($comment->id == Auth::user()->id)
                  <div style="text-align: right;">
                    <p><a class="font-big">{{ $comment->name }}</a> : <small>{{ $comment->created_at }}</small></p>
                    <p>{{ $comment->comment }}</p>
                  </div>
                @else
                  @if(in_array($comment->id,$my_friends))
                    <div>
                        <p><a href="{{ route('userpage',['user_id'=> $comment->id ]) }}" class="font-big">{{ $comment->name }}</a> : {{$comment->created_at}}</p>
                        <p>{{ $comment->comment }}</p>
                    </div>
                  @else
                    <div>
                      <form name="form_name" method="post" action="{{ route('community_add_friend') }}">
                        @csrf
                        <input type="hidden" name="send_user_id" value="{{ $comment->id }}">
                        <p><a class="font-big" href="javascript:form_name.submit()">{{ $comment->name }}</a> : {{$comment->created_at}}</p>
                        <p>{{ $comment->comment }}</p>
                      </form>
                    </div>
                  @endif
                @endif
              @endforeach
            </div>
          </div>

        <br>
        <form method="POST" action="{{ route('community_chat') }}">
          @csrf
          <input type="hidden" name="community_id" value="{{ $community->id }}">
            <div class="input-group mb-3">
              <input type="text" name="comment" class="form-control" placeholder="チャットを送信する" aria-label="..." aria-describedby="button-addon2">
            <div class="input-group-append">
              <button type="submit" id="button-addon2" class="btn btn-outline-secondary">送信</button>
            </div>
          </div>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
            </div>
        @endif

@endsection

@section('footer_javascript')
  <!-- <script>
    // jQueryを使う方法
    function dojQueryAjax() {

        // jQueryのajaxメソッドを使用しajax通信
        $.ajax({
            type: "GET", // GETメソッドで通信
            url: "/community/{{ $community->id }}", // 取得先のURL
            cache: false, // キャッシュしないで読み込み

            // 通信成功時に呼び出されるコールバック
            success: function (data) {
                $('#ajaxreload').html(data);
            },
            // 通信エラー時に呼び出されるコールバック
            error: function () {
                alert("Ajax通信エラー");
            }
        });
    }

    window.addEventListener('load', function () {

        setInterval(dojQueryAjax, 3000);

    });
</script> -->
@endsection
