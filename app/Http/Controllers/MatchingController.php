<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\UserCommunity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MatchingController extends Controller
{
    public function matching_community()
    {
        $communitys = \DB::table('community')
            ->select('id','community_name')->get();

        return view('matching.matching_community',compact('communitys'));
    }

    public function verify_community($community_id)
    {
        $community = \DB::table('community')
            ->select('id','community_name')
            ->where('id',$community_id)
            ->first();

        return view('matching.verify_community',compact('community'));
    }

    public function matched_community(Request $request)
    {
        $user_community= new UserCommunity();
        $user_community->fill([
              'user_id' => (int)Auth::user()->id,
              'community_id' => (int)$request->community_id,
              'interface' => $request->interface,
              'voicechat' => $request->voicechat,
              'server' => $request->serve,
              'rank' => $request->rank,
        ]);
        $user_community->save();

        $community_name = $request->community_name;

        return view('matching.matched_community',compact('community_name'));
    }

    public function matching_user()
    {
        return view('matching.matching_user');
    }

    public function add_community()
    {
        return view('matching.add_community');
    }

    public function verify_add_community(Request $request)
    {
        $community= new Community();
        $community->fill([
              'community_name' => $request->community_name,
        ]);
        $community->save();

        return view('matching.verify_add_community');
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
