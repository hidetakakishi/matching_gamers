@extends('layouts.matching')

@section('navbar')
    <li><a href="{{ route('matching_community') }}">ゲームを見つける</a></li>
    <li class="active"><a href="{{ route('now_community') }}">コミュニティ</a></li>
    <li><a href="{{ route('add_community') }}">コミュニティを作成する</a></li>
    <li><a href="{{ route('chat') }}">ユーザーチャット</a></li>
@endsection

@section('content')
  <div class="container">
    <h3>{{ $users[0]->community_name }}</3>
      <br>
        <br>
      </div>

    <div class="container">
        @for ($i = 0; $i < count($users); $i++)
          @if($i == 0 or $i % 4 == 0)
            <div class="row row-cols-1 row-cols-md-3">
          @endif
              <div class="col mb-4">
                <div class="card h-100">
                  <img src="{{ asset('assets/img/user_noimage.png') }}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-title">{{$users[$i]->name}}</p>
                    <p class="card-text"></p>
                    <p class="card-text"><small class="text-muted">最終更新3分前</small></p>
                  </div>
                </div>
              </div>
          @if($i != 0 and $i % 4 == 0)
          </div>
        @endif
      @endfor
    </div>



      <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3 py-2">
          <nav aria-label="ページ送り">
            <div class="text-center">
              <div class="pagination pagination-minimal justify-content-center">
                <ul>
                  <li class="previous">
                    <a href="#" class="fui-arrow-left"></a>
                  </li>
                  <li class="pagination-dropdown dropup">
                    <a href="#" data-toggle="dropdown">1</a>
                    <a href="#" data-toggle="dropdown">2</a>
                    <a href="#" data-toggle="dropdown">3</a>
                    <a href="#" data-toggle="dropdown">4</a>
                    <a href="#" data-toggle="dropdown">5</a>
                    <a href="#" data-toggle="dropdown">6</a>
                    <a href="#" data-toggle="dropdown">7</a>
                    <a href="#" data-toggle="dropdown">8</a>
                    <a href="#" data-toggle="dropdown">9</a>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="#">10-20</a>
                      </li>
                    </ul>
                  </li>
                  <li class="next">
                    <a href="#" class="fui-arrow-right"></a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
@endsection
