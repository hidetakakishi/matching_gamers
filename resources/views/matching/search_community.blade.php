@extends('layouts.matching')

@section('navbar')
    <li class="active"><a href="{{ route('matching_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('now_community') }}">マイコミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('friend') }}">フレンド</a></li>
@endsection

@section('content')
    <div class="container">
      <h3>ゲームコミュニティに参加しよう</3>
        <br>
          <br>
          <form method="post" action="{{ route('search_community') }}">
            @csrf
          <div class="form-group">
              <label>コミュニティを検索</label>
              <input type="text" class="form-control" name="community_name" placeholder="コミュニティ名">
            </div>
            <div class="form-group col-md-4">
              <select name="select" class="form-control">
                <option value="1" selected>並び替え</option>
                <option value="1">人数が多い順</option>
                <option value="2">人数が少ない順</option>
                <option value="3">作成が新しい順</option>
                <option value="4">作成が古い順</option>
                <option value="5">最終更新が新しい順</option>
                <option value="6">最終更新が古い順</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">検索</button>
          </form>
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
                  <p class="card-text">参加数:{{ $communitys[$i]->community_members }}人</p>
                  <p class="card-text">作成日:{{ $communitys[$i]->created_at->format('Y年m月d日') }}</p>
                  <p class="card-text"><small class="text-muted">最終更新:{{ $communitys[$i]->updated_at->format('m月d日 H時I分') }}</small></p>
                  @unless(in_array($communitys[$i]->id,$my_communitys))
                    <a href="{{ route('verify_community',['community_id'=>$communitys[$i]->id]) }}" class="btn btn-primary">参加する</a>
                  @endunless
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
