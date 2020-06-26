@extends('layouts.matching')

@section('headers')
  <style>
    .community-image {
      width: 350px;
      border-radius: 10px;
    }
    .font-big {
      font-size: 16px;
    }
    .community-user-image {
      width: 100px;
      height: 100px;
    }
  </style>
@endsection

@section('content')
<div class="container page-fade" id="ajaxreload">
  <div class="card mb-3">
    <div class="row no-gutters">
      <div class="col-md-6">
        <img src="{{ $community->community_image }}" class="card-img" alt="...">
      </div>
      <div class="col-md-6">
        <div class="card-body">
          <h5 class="card-title">{{ $community->community_name }}</h5>
          <p class="card-text"><small>{{ $community->community_comment }}</small></p>
          <p class="card-text"><small class="text-muted">作成日:{{ $community->created_at }}</small></p>
        </div>
      </div>
    </div>
  </div>
</div>

  <br>
  <br>
    <div class="container">
      <div class="card page-fade">
        <div class="card-header white">コミュニティメンバー</div>
          <div class="card-body">
            @foreach ($users as $user)
              @if($loop->index != 0 and $loop->index % 3 == 0)
                </div>
              @endif
              @if($loop->index == 0 or $loop->index % 3 == 0)
                <div class="row row-cols-1 row-cols-md-3">
              @endif
              <div class="col-sm-6 col-md-2">
                <a href="#" class="card  non-border flex-center" data-toggle="modal" data-target="#exampleModal{{ $user->id }}">
                  <img class="card-img community-user-image radius" src="{{ $user->user_image }}" alt="...">
                  {{ $user->name }}
                </a>
            </div>
            @endforeach
          </div>
        </div>
      </div>

  <div class="mx-auto" style="width: 200px;">
    {{ $users->links() }}
  </div>
  <br>
  <br>

        <div class="card h-500 w-100 page-fade" style="height: 500px;">
          <div class="card-header white">コミュニティチャット</div>
            <div class="card-body scroll">
              @foreach( $chat as $comment)
                @if($comment->id == Auth::user()->id)
                  <div style="text-align: right;">
                @else
                  <div>
                @endif
                    <p><a href="#" data-toggle="modal" data-target="#exampleModal{{ $comment->id }}">{{ $comment->name }}</a> : {{ $comment->comment }}</p>
                  </div>
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

  @foreach($users as $user)
    <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ $user->name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="flex-center">
              <img src="{{ $user->user_image }}" class="radius" alt="...">
            </div>
            <br>
            <div>
              <p>ゲームハード:{{ $user->interface }}</p>
              <p>ボイスチャット:{{ $user->voicechat }}</p>
              <p>サーバ:{{ $user->serve }}</p>
              <p>ランク:{{ $user->rank }}</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <form method="post" action="{{ route('community_add_friend') }}">
              @csrf
              <input type="hidden" name="send_user_id" value="{{ $user->id }}">
              @unless($user->id == Auth::user()->id)
                @if(in_array($user->id,$my_friends))
                  <a href="{{ route('userpage',['user_id'=>$user->id]) }}" class="btn btn-primary">ユーザーページ</a>
                @else
                  <button type="submit" class="btn btn-embossed btn-primary">
                    フレンドになる
                  </button>
                @endif
              @endunless
            </form>
          </div><!-- /.modal-footer -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  @endforeach

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
