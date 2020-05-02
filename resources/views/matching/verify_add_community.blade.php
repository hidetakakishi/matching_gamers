@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">ゲームを見つける</a></li>
    <li><a href="{{ route('now_community') }}">コミュニティ</a></li>
    <li class="active"><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('chat') }}">ユーザーチャット</a></li>
@endsection

@section('content')
        <div class="container">
          <div class="media">
            <a href="#" class="mr-3">
              <img src="{{ $image }}" alt="メディアの画像">
            </a>
            <div class="media-body">
              <h5 class="mt-0">{{ $community_name }}</h5>
              <p class="mt-0">コミュニティを作成しました。</p>
              <div>
                <a href="{{ route('verify_community',['community_id' => $community_id->id]) }}" class="btn btn-primary">コミュニティに参加する</a>
              </div>
            </div>
          </div>
        </div>
@endsection
