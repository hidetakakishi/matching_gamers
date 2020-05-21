@extends('layouts.matching')

@section('header')
  <style>
      .custom-file {
    overflow: hidden;
    }
    .custom-file-label {
      white-space: nowrap;
    }
  </style>
@endsection

@section('content')
    <form method="POST" action="{{ route('update_mypage') }}" enctype="multipart/form-data">
      @csrf
      <div class="container">
        <div class="card">
          <div class="card-header">マイページ編集</div>
            <div class="card-body">
                <div class="media">
                  <a href="#" class="mr-3">
                    <img src="{{ Auth::user()->user_image }}" alt="ユーザーイメージ" id="preview">
                  </a>
                  <div class="media-body">
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
                      <textarea type="text" class="form-control" name="profile" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">{{ Auth::user()->profile }}</textarea>
                    </div>

                    ゲームアカウント
                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="game_hard1" value="{{$user_game_account[0]->game_hard}}" placeholder="例:PS4">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="account1" value="{{ $user_game_account[0]->account }}" placeholder="アカウント名">
                        </div>
                      </div>

                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="game_hard2" value="{{$user_game_account[1]->game_hard}}" placeholder="例:steam">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="account2" value="{{ $user_game_account[1]->account }}" placeholder="アカウント名">
                        </div>
                      </div>

                      <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="game_hard3" value="{{$user_game_account[2]->game_hard}}" placeholder="例:discord">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="account3" value="{{ $user_game_account[2]->account }}" placeholder="アカウント名">
                        </div>
                      </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">アップロード</span>
                      </div>
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" aria-describedby="inputGroupFileAddon01" id="customFile" accept='image/*' onchange="previewImage(this);">
                        <label class="custom-file-label" for="inputGroupFileAddon01" data-browse="参照">ファイル選択...</label>
                      </div>
                    </div>

              </div>
            </div>
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

      <br>
      <br>
    </form>
@endsection

@section('footer_javascript')
  <script>
    $('.custom-file-input').on('change',function(){
      $(this).next('.custom-file-label').html($(this)[0].files[0].name);
    })

    function previewImage(obj)
    {
    	var fileReader = new FileReader();
    	fileReader.onload = (function() {
    		document.getElementById('preview').src = fileReader.result;
    	});
    	fileReader.readAsDataURL(obj.files[0]);
    }
  </script>
@endsection
