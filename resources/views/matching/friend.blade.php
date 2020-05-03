@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li class="active"><a href="{{ route('friend') }}">フレンド</a></li>
@endsection

@section('content')
    <div class="container">
      <h5>フレンド</h5>
    </div>
@endsection
