@extends('layouts.matching')

@section('navbar')
    <li class="active"><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('chat') }}">フレンド</a></li>
@endsection

@section('content')
    <div class="container">
      <h3>ゲームコミュニティに参加しよう</3>
        <br>
          <br>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="" />
              <span class="input-group-text">検索</span>
          </div>
          <br>
        </div>

    <form method="get">
      <div class="container">
        @for ($i = 0; $i < count($communitys); $i++)
          @if($i == 0 or $i % 4 == 0)
            <div class="row row-cols-1 row-cols-md-3">
          @endif
            <div class="col mb-4">
              <div class="card h-100">
                <img src="{{ $communitys[$i]->community_image }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $communitys[$i]->community_name }}</h5>
                  <p class="card-text"></p>
                  <a href="{{ route('verify_community',['community_id'=>$communitys[$i]->id]) }}" class="btn btn-primary">参加する</a>
                </div>
              </div>
            </div>
          @if($i != 0 and $i % 4 == 0)
            </div>
          @endif
        @endfor
      </div>
    </form>

    <div class="mx-auto" style="width: 200px;">
  {{ $communitys->links() }}
</div>

@endsection
