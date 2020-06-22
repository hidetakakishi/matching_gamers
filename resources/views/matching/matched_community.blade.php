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
  <div class="container small-container">
    <div class="card img-thumbnail">
      <h5 class="card-header white">コミュニティ作成完了</h5>
      <img class="mx-auto img-radius" src="{{ $community->community_image }}" alt="メディアの画像">
      <div class="card-body">
        <p class="mt-0">{{ $community->community_name }}に参加しました。</p>
        <div>
          <a href="{{ route('community',['community_id' => $community->id]) }}" class="btn btn-primary">コミュニティを見る</a>
        </div>
      </div>
    </div>
  </div>
@endsection
