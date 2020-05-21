@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li class="active"><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('friend') }}">フレンド</a></li>
@endsection

@section('content')
      <div class="container">
          @for ($i = 0; $i < count($communitys); $i++)
            @if($i == 0 or $i % 4 == 0)
              <div class="row row-cols-1 row-cols-md-3">
            @endif
                <div class="col mb-4">
                  <div class="card h-100 fade">
                    <img src="{{ $communitys[$i]->community_image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <p class="card-title">{{$communitys[$i]->community_name}}</p>
                      <p class="card-text">参加数:{{ $communitys[$i]->community_members }}人</p>
                      <p class="card-text">作成日:{{ $communitys[$i]->created_at->format('Y年m月d日') }}</p>
                      <p class="card-text"><small class="text-muted">最終更新:{{ $communitys[$i]->updated_at->format('m月d日 H時I分') }}</small></p>
                      <a href="{{ route('community',['community_id'=>$communitys[$i]->id]) }}" class="btn btn-primary">コミュ二ティページ</a>
                    </div>
                  </div>
                </div>
            @if($i != 0 and $i % 4 == 0)
            </div>
          @endif
        @endfor
      </div>

      <div class="mx-auto" style="width: 200px;">
    {{ $communitys->links() }}
  </div>
@endsection
