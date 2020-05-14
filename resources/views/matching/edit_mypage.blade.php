@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('friend') }}">フレンド</a></li>
@endsection

@section('content')
    <form method="POST" action="{{ route('update_mypage') }}" enctype="multipart/form-data">
      @csrf
      <div class="container">
        <div class="media">
          <a href="#" class="mr-3">
            <img src="{{ asset('assets/img/user_noimage.png') }}" alt="ユーザーイメージ" id="preview">
          </a>
          <div class="media-body">
            <h5 class="mt-0">ユーザー情報</h5>
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">ユーザー名</span>
              </div>
              <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">性別</span>
              </div>
              <input type="text" class="form-control" name="sex" value="{{ Auth::user()->sex }}" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">年齢</span>
              </div>
              <input type="text" class="form-control" name="age" value="{{ Auth::user()->age }}" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
            </div>

            @for($i = 0;$i <= 2;$i++)
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">ゲームアカウント{{ $i + 1 }}</span>
                </div>
                <div class="col">
                  <input type="text" class="form-control" name="game_hard{{ $i }}" value="{{$user_game_account[$i]->game_hard}}" placeholder="ゲームハード">
                </div>
                <div class="col">
                  <input type="text" class="form-control" name="account{{ $i }}" value="{{ $user_game_account[$i]->account }}" placeholder="アカウント">
                </div>
              </div>
            @endfor

            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">SNS</span>
              </div>
              <input type="text" class="form-control" name="sns" value="{{ Auth::user()->sns }}" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">URL</span>
              </div>
              <input type="text" class="form-control" name="url" value="{{ Auth::user()->url }}" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">プロフィール</span>
              </div>
              <input type="text" class="form-control" name="profile" value="{{ Auth::user()->profile }}" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div>
              <button type="submit" class="btn btn-embossed btn-primary">
                保存
              </button>
            </div>
          </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
            </div>
        @endif
      </div>
      <br>
      <br>
      <div class="container">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">アップロード</span>
          </div>
          <div class="custom-file">
            <input type="file" name="image" id="inputGroupFile01" id="uploadeImage" accept="image/*" enctype="multipart/form-data" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01" data-browse="">ファイル選択...</label>
          </div>
        </div>
      </div>
    </form>
    <script>
    // $('#uploadeImage').on('change', function (e) {
    //     var reader = new FileReader();
    //     reader.onload = function (e) {
    //         $("#preview").attr('src', e.target.result);
    //     }
    //     reader.readAsDataURL(e.target.files[0]);
    // });
    </script>
@endsection
