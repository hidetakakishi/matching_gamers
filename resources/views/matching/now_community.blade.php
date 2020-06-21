@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li class="active"><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('friend') }}">フレンド</a></li>
@endsection

@section('content')
  <div class="container">
    @foreach ($communitys as $community)
      @if($loop->index != 0 and $loop->index % 3 == 0)
        </div>
      @endif
      @if($loop->index == 0 or $loop->index % 3 == 0)
        <div class="row row-cols-1 row-cols-md-3">
      @endif
        <div class="col mb-4">
          <div class="card h-100 fade">
            <img src="{{ $community->community_image }}" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-title">{{ $community->community_name }}</p>
              <p class="card-text">参加数:{{ $community->community_members }}人</p>
              <p class="card-text">作成日:{{ $community->created_at->format('Y年m月d日') }}</p>
              <p class="card-text"><small class="text-muted">最終更新:{{ $community->updated_at->format('m月d日 H時I分') }}</small></p>
              <a href="{{ route('community',['community_id'=>$community->id]) }}" class="btn btn-primary">コミュ二ティページ</a>
            </div>
          </div>
        </div>
    @endforeach
  </div>

      <div class="mx-auto" style="width: 200px;">
    {{ $communitys->links() }}
  </div>
@endsection
