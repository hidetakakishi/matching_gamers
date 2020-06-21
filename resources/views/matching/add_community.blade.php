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
      width: 300px;
      height: 200px;
      margin-top: 20px;
    }
  </style>
@endsection

@section('content')
    <form method="POST" action="{{ route('verify_add_community') }}" enctype="multipart/form-data">
      @csrf
        <div class="container">
          <div class="card img-thumbnail">
            <h5 class="card-header white">コミュニティ作成</h5>
              <img class="mx-auto img-radius" id="preview" src="{{ asset('assets/img/game_noimage.jpg') }}" alt="メディアの画像">
              <div class="card-body">
                <div class="form-group">
                  <input type="text" name="community_name" class="form-control radius" id="exampleInputEmail1" placeholder="コミュニティ名">
                </div>

                <div class="form-group">
                  <textarea id="textarea1" class="form-control" name="community_comment" placeholder="コミュニティの説明..."></textarea>
                </div>

                <label for="validationTextarea">コミュニティ参加時の入力項目</label>
              <div class="margin-bottom">
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" class="custom-control-input" id="customCheck1" name="interface" value="true">
                  <label class="custom-control-label" for="customCheck1">ゲームハード</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" class="custom-control-input" id="customCheck2" name="voicechat" value="true">
                  <label class="custom-control-label" for="customCheck2">ボイスチャット</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" class="custom-control-input" id="customCheck3" name="serve" value="true">
                  <label class="custom-control-label" for="customCheck3">サーバー</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" class="custom-control-input" id="customCheck4" name="rank" value="true">
                  <label class="custom-control-label" for="customCheck4">ランク</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" class="custom-control-input" id="customCheck5" name="level" value="true">
                  <label class="custom-control-label" for="customCheck5">レベル</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" class="custom-control-input" id="customCheck6" name="play_time" value="true">
                  <label class="custom-control-label" for="customCheck6">プレイ時間</label>
                </div>
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">画像アップロード</span>
                </div>
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" aria-describedby="inputGroupFileAddon01" id="customFile" accept='image/*' onchange="previewImage(this);">
                  <label class="custom-file-label" for="inputGroupFileAddon01" data-browse="参照">ファイル選択...</label>
                </div>
              </div>
              <button type="submit" class="btn btn-embossed btn-primary">
                作成する
              </button>

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
