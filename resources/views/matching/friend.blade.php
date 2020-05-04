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
      <div class="card h-500 w-100" style="height: 500px;">
        <div class="card-header">フレンド一覧</div>
          <div class="card-body">
          </div>
        </div>
        <div class="card h-500 w-100" style="height: 500px;">
          <div class="card-header">フレンド申請</div>
            <div class="card-body">
            </div>
          </div>
        </div>
@endsection
