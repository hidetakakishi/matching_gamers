@extends('layouts.matching')

@section('headers')
  <style>
    .right{
      float: right;
    }

  </style>

@endsection

@section('content')
    <div class="container">
          <form method="post" action="{{ route('search_community') }}">
            @csrf
          <div class="form-group">
              <input type="text" class="form-control" name="community_name" placeholder="コミュニティを検索">
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
            <button type="submit" class="btn btn-primary" >検索</button>
          </form>
        </div>
        <br>

    <form method="get">
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
                  @unless(in_array($community->id,$my_communitys))
                    <a href="{{ route('verify_community',['community_id'=>$community->id]) }}" class="btn btn-primary">参加する</a>
                  @endunless
                </div>
              </div>
            </div>
        @endforeach
      </div>
    </form>

    <div class="mx-auto" style="width: 200px;">
  {{ $communitys->links() }}
</div>
@endsection

@section('footer_javascript')
@endsection
