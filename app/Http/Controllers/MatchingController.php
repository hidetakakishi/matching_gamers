<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\UserCommunity;
use App\CommunityChat;
use App\Friend;
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
        $community = \DB::table('community')
            ->select('id','community_name','community_image')
            ->where('id',$community_id)
            ->first();

        $users = \DB::table('user_community')
            ->join('users', 'user_community.user_id', '=', 'users.id')
            ->select('users.id','users.name','users.user_image',
            'user_community.interface','user_community.voicechat',
            'user_community.serve','user_community.rank')
            ->where('community_id',$community_id)
            ->simplePaginate(16);

        $friends = \DB::table('friend')
            ->select('send_user_id')
            ->where('post_user_id',Auth::user()->id)
            ->get();

        $user_friend = [];
        foreach($friends as $id){
            array_push($user_friend,$id->send_user_id);
        }

        $chat = \DB::table('community_chat')
            ->join('users', 'community_chat.user_id', '=', 'users.id')
            ->select('comment','community_chat.created_at','users.id','users.name')
            ->where('community_id',$community_id)
            ->get();

        return view('matching.community',compact('community','users','user_friend','chat'));
    }

    public function community_add_friend(Request $request)
    {
        $friend = Friend::create([
              'post_user_id' => Auth::user()->id,
              'send_user_id' => $request->send_user_id
        ]);

        $community_id = $request->community_id;
        session()->flash('flash_message', 'フレンド申請を送りました');
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

    public function matching_community()
    {
        $communitys = \DB::table('community')
            ->select('id','community_name','community_image')
            ->simplePaginate(16);

        $my_community = \DB::table('user_community')
            ->select('community_id')
            ->where('user_id',Auth::user()->id)
            ->get();

        $my_communitys = [];
        foreach($my_community as $id){
            array_push($my_communitys,$id->community_id);
        }

        return view('matching.matching_community',compact('communitys','my_communitys'));
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
            ->select('community.id','community.community_name','community.community_image')
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
        $friends = \DB::table('friend')
            ->join('users','friend.send_user_id','=','users.id')
            ->select('users.id','users.name')
            ->where('friend.post_user_id',Auth::user()->id)
            ->where('friend.status',1)
            ->get();

        $friend_request = \DB::table('friend')
            ->join('users','friend.send_user_id','=','users.id')
            ->select('users.id','users.name')
            ->where('friend.send_user_id',Auth::user()->id)
            ->where('friend.status',0)
            ->get();

        $post_request = \DB::table('friend')
            ->join('users','friend.send_user_id','=','users.id')
            ->select('users.id','users.name')
            ->where('friend.post_user_id',Auth::user()->id)
            ->where('friend.status',0)
            ->get();


        return view('matching.friend',compact('friends','friend_request','post_request'));
    }

    public function friend_check(Request $request)
    {
        $update_friend_status = Friend::where('post_user_id',Auth::user()->id)
            ->where('send_user_id',$request->user_id)
            ->where('status',0)
            ->first();
        $update_friend_status->status = 1;
        $update_friend_status->save();

        return redirect()->route('friend');
    }

    public function friend_delete(Request $request)
    {
        Friend::where('post_user_id',Auth::user()->id)
            ->where('send_user_id',$request->user_id)
            ->delete();

        return redirect()->route('friend');
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

    public function userpage($user_id)
    {
        $bool = \DB::table('friend')
        ->where('post_user_id', Auth::user()->id)
        ->where('send_user_id', $user_id)
        ->exists();

        if($bool){

            $user = \DB::table('users')
                ->select('name','age','sex','profile','user_image')
                ->where('id',$user_id)
                ->first();

            $user_community = \DB::table('user_community')
                ->join('community','user_community.community_id','=','community.id')
                ->select('community.id','community.community_name','community.community_image')
                ->where('user_community.user_id',$user_id)
                ->first();

            $my_community = \DB::table('user_community')
                ->select('community_id')
                ->where('user_id',Auth::user()->id)
                ->get();

            $my_communitys = [];
            foreach($my_community as $id){
                array_push($my_communitys,$id->community_id);
            }
        }else{
            return back();
        }

        return view('matching.userpage',compact('user','user_community','my_communitys'));
    }

}
