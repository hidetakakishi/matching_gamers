@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li class="active"><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('friend') }}">フレンド</a></li>
@endsection

@section('content')
    <div class="container">
      <h3>参加中のコミュニティ</3>
        <br>
        <br>
        </div>

      <div class="container">
          @for ($i = 0; $i < count($communitys); $i++)
            @if($i == 0 or $i % 4 == 0)
              <div class="row row-cols-1 row-cols-md-3">
            @endif
                <div class="col mb-4">
                  <div class="card h-100">
                    <img src="{{ $communitys[$i]->community_image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <p class="card-title">{{$communitys[$i]->community_name}}</p>
                      <p class="card-text"></p>
                      <!-- <p class="card-text"><small class="text-muted">最終更新3分前</small></p> -->
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
