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
    <form method="POST" action="{{ route('verify_add_community') }}" enctype="multipart/form-data">
      @csrf
        <div class="container">
          <div class="media">
            <a href="#" class="mr-3">
              <img id="preview" src="{{ asset('assets/img/game_noimage.jpg') }}" alt="メディアの画像">
            </a>
            <div class="media-body">
              <h5 class="mt-0">コミュニティ作成</h5>
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">コミュニティ名</span>
                </div>
                <input type="text" class="form-control" name="community_name" placeholder="30文字以内で入力してください" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
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
