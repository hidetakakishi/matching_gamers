<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\UserCommunity;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

        $community_id = \DB::table('community')
            ->select('id')
            ->where('community_name',$request->community_name)
            ->first();

        $file_path = $request->file('image');
        $community_image_name = $community_id->id.'.jpg';

        Storage::disk('s3')->putFileAs('/community',$file_path,$community_image_name,'public');
        $image = Storage::disk('s3')->url('community/'.$community_image_name);

        $update_community_image = Community::where('id',$community_id->id)->first();
        $update_community_image->community_image = $community_image_name;
        $community_name = $request->community_name;

        return view('matching.verify_add_community',compact('image','community_name','community_id'));
    }

    public function chat()
    {
        return view('matching.chat');
    }

    public function mypage()
    {
        $image = Storage::disk('s3')->url('users/'.Auth::user()->user_image);
        return view('matching.mypage',compact('image'));
    }

    public function edit_mypage()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('matching.edit_mypage');
    }

    public function update_mypage(Request $request)
    {

        $user = User::where('id', Auth::user()->id)->first();

        $file = $request->file('image');
        $user_image_name = Auth::user()->id.'.jpg';

        $image = Storage::disk('s3')->putFileAs('/users',$file,$user_image_name,'public');

        $user->name = $request->name;
        $user->age = $request->age;
        $user->sex = $request->sex;
        $user->profile = $request->profile;
        $user->user_image = $user_image_name;
        $user->save();

        return redirect()->route('mypage');
    }
}
