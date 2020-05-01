@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">ゲームを見つける</a></li>
    <li><a href="{{ route('now_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li class="active"><a href="{{ route('chat') }}">ユーザーチャット</a></li>
@endsection

@section('content')
    <div class="container">
      <h5>チャット</h5>
    </div>
@endsection
