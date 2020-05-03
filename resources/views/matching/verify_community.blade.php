@extends('layouts.matching')

@section('navbar')
    <li class="active"><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('friend') }}">フレンド</a></li>
@endsection

@section('content')
    <form method="POST" action="{{ route('matched_community') }}">
      @csrf
        <div class="container">
          <div class="media">
            <a href="#" class="mr-3">
              <img src="{{ asset('assets/img/game_noimage.jpg') }}" alt="メディアの画像">
            </a>
            <div class="media-body">
              <h5 class="mt-0">{{$community->community_name}}</h5>

              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">ハード</span>
                </div>
                <input type="text" class="form-control" name="interface" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
              </div>

              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">ボイスチャット</span>
                </div>
                <input type="text" class="form-control" name="voicechat" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
              </div>

              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">サーバー</span>
                </div>
                <input type="text" class="form-control" name="serve" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
              </div>

              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">ランク</span>
                </div>
                <input type="text" class="form-control" name="rank" placeholder="" aria-label="サイズの入力例" aria-describedby="inputGroup-sizing-sm">
              </div>

              <input type="hidden" name="community_id" value="{{$community->id}}">
              <input type="hidden" name="community_name" value="{{$community->community_name}}">

              <button type="submit" class="btn btn-embossed btn-primary">
                参加する
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
