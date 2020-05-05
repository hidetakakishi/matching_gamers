@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('friend') }}">フレンド</a></li>
@endsection

@section('content')
    <form method="GET">
      <div class="container">
        <div class="media">
          <a href="#" class="mr-3">
            <img src="{{ $user->user_image }}" alt="メディアの画像">
          </a>
          <div class="media-body">
            <h5 class="mt-0">ユーザー情報</h5>
            <p>ユーザー名:{{ $user->name }}</p>
            <p>年齢:{{ $user->age }}</p>
            <p>性別:{{ $user->sex }}</p>
            <p>【プロフィール】</p>
            <p>{{ $user->profile }}</p>
          </div>
        </div>
      </div>
    </form>

    <div class="container">
      <h3>参加中のコミュニティ</3>
        <br>
        <br>
        </div>

      <div class="container">
        <div class="col mb-4">
          <div class="card h-100">
            <img src="{{ $user_community->community_image }}" class="card-img-top" alt="...">
              <div class="card-body">
                <p class="card-title">{{$user_community->community_name}}</p>
                <p class="card-text"></p>
                @unless(in_array($user_community->id,$my_communitys))
                  <a href="{{ route('verify_community',['community_id'=>$user_community->id]) }}" class="btn btn-primary">参加する</a>
                @endif
              </div>
            </div>
          </div>
        </div>

@endsection
