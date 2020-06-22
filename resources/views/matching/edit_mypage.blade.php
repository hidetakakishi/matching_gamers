@extends('layouts.matching')

@section('headers')
  <style>
      .custom-file {
    overflow: hidden;
    }
    .custom-file-label {
      white-space: nowrap;
    }
    img {
      width: 150px;
      height: 150px;
    }
  </style>
@endsection

@section('content')
  <form method="POST" action="{{ route('update_mypage') }}" enctype="multipart/form-data">
      @csrf
    <div class="container mini-container">
      <div class="card  flex-center non-border">
        <img src="{{ Auth::user()->user_image }}" class="radius margin-bottom" alt="ユーザーイメージ" id="preview">
        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control radius margin-bottom" style="width: 200px;" placeholder="名前">
        <br>
        <br>
        <div class="col margin-bottom">
          <small class="text-muted">性別</small>
          <input type="text" name="sex" value="{{ Auth::user()->sex }}" class="form-control radius" placeholder="性別">
        </div>
        <div class="col margin-bottom">
          <small class="text-muted">年齢</small>
          <input type="text" name="age" value="{{ Auth::user()->age }}" class="form-control radius" placeholder="年齢">
        </div>
        <div class="col margin-bottom">
          <small class="text-muted">SNS</small>
          <input type="text" name="sns" value="{{ Auth::user()->sns }}" class="form-control radius" placeholder="SNS">
        </div>
        <div class="col margin-bottom">
          <small class="text-muted">URL</small>
          <input type="text" name="url" value="{{ Auth::user()->url }}" class="form-control radius" placeholder="URL">
        </div>
        @foreach($user_game_account as $account)
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
            </div>
            <div class="col">
              <small class="text-muted">ゲームアカウント{{ $loop->iteration }}</small>
              <input type="text" class="form-control radius" name="game_hard{{ $loop->index }}" value="{{ $account->game_hard }}" placeholder="インターフェイス">
            </div>
            <div class="col">
              <br>
              <input type="text" class="form-control radius" name="account{{ $loop->index }}" value="{{ $account->account }}" placeholder="アカウント">
            </div>
          </div>
        @endforeach
        <div class="col">
          <small class="text-muted">プロフィール</small>
          <textarea id="textarea1" class="form-control  margin-bottom" name="profile" value="{{ Auth::user()->profile }}" placeholder="プロフィール..."></textarea>
        </div>

        <div class="col">
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
      <div class="col">
        <button type="submit" class="btn btn-embossed btn-primary">
          保存
        </button>
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
