@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">本会員登録完了</div>

                    <div class="card-body">
                        <p>アカウント作成が完了しました。</p>
                        <a href="{{ route('matching_community') }}">コミュニティに参加する</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
