<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatchingController extends Controller
{
    public function game_community()
    {
        return view('matching.game_community');
    }

    public function user_matching()
    {
        return view('matching.user_matching');
    }

    public function add_community()
    {
        return view('matching.add_community');
    }

    public function chat()
    {
        return view('matching.chat');
    }

    public function mypage()
    {
        return view('matching.mypage');
    }

}
