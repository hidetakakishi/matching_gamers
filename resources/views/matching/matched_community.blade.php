@extends('layouts.matching')

@section('navbar')
    <li  class="active"><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('chat') }}">フレンド</a></li>
@endsection


@section('content')
        <div class="container">
          <div class="media">
            <a href="#" class="mr-3">
              <img src="{{ asset('assets/img/user_noimage.png') }}" alt="メディアの画像">
            </a>
            <div class="media-body">
              <h5 class="mt-0">{{ $community_name }}</h5>
              <p class="mt-0">コミュニティに参加しました。</p>
              <div>
                <a href="{{ route('community',['community_id' => $community_id]) }}" class="btn btn-primary">コミュニティを見る</a>
              </div>
            </div>
          </div>
        </div>
@endsection
