<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\UserCommunity;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MatchingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function community($community_id)
    {
        $users = \DB::table('user_community')
            ->join('users', 'user_community.user_id', '=', 'users.id')
            ->join('community', 'user_community.community_id', '=', 'community.id')
            ->select('name','community.community_name')
            ->where('community_id',$community_id)
            ->get();

        return view('matching.community',compact('users'));
    }


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
        $community_id = $request->community_id;
        return view('matching.matched_community',compact('community_name','community_id'));
    }

    public function now_community()
    {
        $communitys = \DB::table('user_community')
            ->join('community','community.id','=','user_community.community_id')
            ->join('users','users.id','=','user_community.user_id')
            ->select('community.community_name','user_community.community_id')
            ->where('users.id',Auth::user()->id)
            ->get();

        return view('matching.now_community',compact('communitys'));
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

    public function edit_mypage()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('matching.edit_mypage');
    }

    public function update_mypage(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->age = $request->age;
        $user->sex = $request->sex;
        $user->profile = $request->profile;
        $user->save();

        return redirect()->route('mypage');
    }
}
