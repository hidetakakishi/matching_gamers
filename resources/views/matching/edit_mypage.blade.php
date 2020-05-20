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
              <textarea type="text" class="form-control" name="profile" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">{{ Auth::user()->profile }}</textarea>
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
            <input type="file" name="image" class="custom-file-input" aria-describedby="inputGroupFileAddon01" id="customFile" accept='image/*' onchange="previewImage(this);">
            <label class="custom-file-label" for="inputGroupFileAddon01" data-browse="参照">ファイル選択...</label>
          </div>
        </div>
      </div>
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
