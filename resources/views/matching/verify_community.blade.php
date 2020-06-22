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
  <form method="POST" action="{{ route('matched_community') }}" enctype="multipart/form-data">
  @csrf
    <div class="container small-container">
      <div class="card img-thumbnail">
        <h5 class="card-header white">コミュニティ参加</h5>
          <img class="mx-auto img-radius" id="preview" src="{{ $community->community_image }}" alt="メディアの画像">
          <div class="card-body">
            <div><small>{{ $community->community_comment}}</small></div>
            <br>
            @foreach($community_flag as $key => $flag)
              @if($flag)
                <div class="form-group">
                  @switch($key)
                    @case('interface_flag')
                      <input type="text" name="{{ $key }}" class="form-control radius" id="exampleInputEmail1" placeholder="ゲームハード">
                      @break
                    @case('voicechat_flag')
                      <input type="text" name="{{ $key }}" class="form-control radius" id="exampleInputEmail1" placeholder="ボイスチャット">
                      @break
                    @case('serve_flag')
                      <input type="text" name="{{ $key }}" class="form-control radius" id="exampleInputEmail1" placeholder="サーバ">
                      @break
                    @case('rank_flag')
                      <input type="text" name="{{ $key }}" class="form-control radius" id="exampleInputEmail1" placeholder="ランク">
                      @break
                    @case('level_flag')
                      <input type="text" name="{{ $key }}" class="form-control radius" id="exampleInputEmail1" placeholder="レベル">
                      @break
                    @case('play_time_flag')
                      <input type="text" name="{{ $key }}" class="form-control radius" id="exampleInputEmail1" placeholder="プレイ時間">
                      @break
                    @default
                      <input type="hidden" name="{{ $key }}" value="">
                      @break
                  @endswitch
                </div>
              @endif
            @endforeach

            <input type="hidden" name="community_id" value="{{$community->id}}">
            <input type="hidden" name="community_name" value="{{$community->community_name}}">

            <button type="submit" class="btn btn-embossed btn-primary">
              {{ $community->community_name }}に参加する
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
