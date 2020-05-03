<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\UserCommunity;
use App\CommunityChat;
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
            ->select('users.id','users.name','users.user_image','user_community.interface','user_community.voicechat',
            'user_community.serve','user_community.rank',
            'community.id','community.community_name','community.community_image')
            ->where('community_id',$community_id)
            ->simplePaginate(16);

        $chat = \DB::table('community_chat')
            ->join('users', 'community_chat.user_id', '=', 'users.id')
            ->select('comment','community_chat.created_at','users.id','users.name')
            ->where('community_id',$community_id)
            ->get();

        return view('matching.community',compact('users','chat'));
    }


    public function matching_community()
    {
        $communitys = \DB::table('community')
            ->select('id','community_name','community_image')
            ->simplePaginate(16);

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

        $request->validate([
            'interface' => 'max:255',
            'voicechat' => 'max:255',
            'serve' => 'max:255',
            'rank' => 'max:255',
        ]);

        $user_community= new UserCommunity();
        $user_community->fill([
              'user_id' => (int)Auth::user()->id,
              'community_id' => (int)$request->community_id,
              'interface' => $request->interface,
              'voicechat' => $request->voicechat,
              'serve' => $request->serve,
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
            ->simplePaginate(16);

        return view('matching.now_community',compact('communitys'));
    }

    public function add_community()
    {
        return view('matching.add_community');
    }

    public function verify_add_community(Request $request)
    {
        $request->validate([
            'community_name' => 'unique:community|max:30',
        ]);

        $image;
        $file_path = $request->file('image');

        $community= new Community();

        //コミュニティ名だけinsertしてidを生成
        $community->fill([
              'community_name' => $request->community_name,
        ]);
        $community->save();

        $community_id = \DB::table('community')
            ->select('id')
            ->where('community_name',$request->community_name)
            ->first();

        //画像の名前はcomunity_id.jpg、画像が存在しないときはno_image
        if(file_exists($file_path)){
              $community_image_name = $community_id->id.'.jpg';
              $image_key = Storage::disk('s3')->putFileAs('/community',$file_path,$community_image_name,'public');
              $image = Storage::disk('s3')->url($image_key);
        }else{
              $image = Storage::disk('s3')->url('community/community_noimage.jpeg');
        }

        $update_community_image = Community::where('id',$community_id->id)->first();
        $update_community_image->community_image = $image;
        $update_community_image->save();

        $community_name = $request->community_name;

        return view('matching.verify_add_community',compact('image','community_name','community_id'));
    }

    public function friend()
    {
        return view('matching.friend');
    }

    public function getchat()
    {
        $comment = CommunityChat::create([
              'user_id' => Auth::user()->id,
              'community_id' => $request->community_id,
              'comment' => $request->comment
        ]);

        $community_id = $request->community_id;

        return redirect()->route('community',['community_id' => $community_id]);
    }

    public function community_chat(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment = CommunityChat::create([
              'user_id' => Auth::user()->id,
              'community_id' => $request->community_id,
              'comment' => $request->comment
        ]);

        $community_id = $request->community_id;

        return redirect()->route('community',['community_id' => $community_id]);
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

        $request->validate([
            'name' => 'max:255',
            'age' => 'max:255',
            'sex' => 'max:255',
            'profile' => 'max:255'
        ]);

        $image;
        $file_path = $request->file('image');

        //画像の名前はuser_id.jpg、画像が存在しないときはno_image
        if(file_exists($file_path)){
              $user_image_name = Auth::user()->id.'.jpg';
              $image_key = Storage::disk('s3')->putFileAs('/users',$file_path,$user_image_name,'public');
              $image = Storage::disk('s3')->url($image_key);
        }else{
              $image = Storage::disk('s3')->url('users/user_noimage.png');
        }

        $user = User::where('id', Auth::user()->id)->first();

        $user->name = $request->name;
        $user->age = $request->age;
        $user->sex = $request->sex;
        $user->profile = $request->profile;
        $user->user_image = $image;
        $user->save();

        return redirect()->route('mypage');
    }
}
