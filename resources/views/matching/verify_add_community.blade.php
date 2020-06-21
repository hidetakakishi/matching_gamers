@extends('layouts.matching')

@section('headers')
  <style>
    img {
      width: 300px;
      height: 200px;
      margin-top: 20px;
    }
  </style>
@endsection

@section('content')
  <div class="container">
    <div class="card img-thumbnail">
      <h5 class="card-header white">コミュニティ作成完了</h5>
      <img class="mx-auto img-radius" src="{{ $image }}" alt="メディアの画像">
      <div class="card-body">
        <h5 class="mt-0">{{ $community_name }}</h5>
        <p class="mt-0">コミュニティを作成しました。</p>
        <div>
          <a href="{{ route('verify_community',['community_id' => $community_id->id]) }}" class="btn btn-primary">コミュニティに参加する</a>
        </div>
      </div>
    </div>
  </div>
@endsection
