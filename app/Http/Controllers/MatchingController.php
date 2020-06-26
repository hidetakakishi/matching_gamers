<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\UserCommunity;
use App\CommunityChat;
use App\Friend;
use App\GameAccount;
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
            ->select('id','community_name','community_image','community_comment','created_at')
            ->where('id',$community_id)
            ->first();

        $users = \DB::table('user_community')
            ->join('users', 'user_community.user_id', '=', 'users.id')
            ->select('users.id','users.name','users.user_image',
            'user_community.interface','user_community.voicechat',
            'user_community.serve','user_community.rank')
            ->where('community_id',$community_id)
            ->simplePaginate(15);

        $my_friend = \DB::table('friend')
            ->select('post_user_id','send_user_id')
            ->where('post_user_id',Auth::user()->id)
            ->orwhere('send_user_id',Auth::user()->id)
            ->get();

        $my_friends = [];

        foreach ($my_friend as $friend) {
            array_push($my_friends,$friend->post_user_id,$friend->send_user_id);
        }

        $chat = \DB::table('community_chat')
            ->join('users', 'community_chat.user_id', '=', 'users.id')
            ->select('comment','community_chat.created_at','users.id','users.name')
            ->where('community_id',$community_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('matching.community',compact('community','users','my_friends','chat'));
    }

    public function community_add_friend(Request $request)
    {
        $friend = Friend::create([
              'post_user_id' => Auth::user()->id,
              'send_user_id' => $request->send_user_id
        ]);

        return back()->with('flash_message', 'フレンド申請を送りました');
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

        $community_update = Community::where('id', $request->community_id)->first();
        $community_update->updated_at = now();
        $community_update->save();

        $community_id = $request->community_id;

        return redirect()->route('community',['community_id' => $community_id]);
    }

    // public function matching_community()
    // {
    //     $communitys = Community::query()
    //         ->select('id','community_name','community_image','community_members','created_at','updated_at')
    //         ->orderBy('community_members', 'desc')
    //         ->simplePaginate(12);
    //
    //     $my_community = \DB::table('user_community')
    //         ->select('community_id')
    //         ->where('user_id',Auth::user()->id)
    //         ->get();
    //
    //     $my_communitys = [];
    //     foreach($my_community as $id){
    //         array_push($my_communitys,$id->community_id);
    //     }
    //
    //     return view('matching.matching_community',compact('communitys','my_communitys'));
    // }

    // public function search_community(Request $request)
    // {
    //     $select;
    //     $order;
    //     switch ($request->select) {
    //         case 1:
    //             $select = 'community_members';
    //             $order = 'desc';
    //             break;
    //         case 2:
    //             $select = 'community_members';
    //             $order = 'asc';
    //             break;
    //         case 3:
    //             $select = 'created_at';
    //             $order = 'desc';
    //             break;
    //         case 4:
    //             $select = 'created_at';
    //             $order = 'asc';
    //             break;
    //         case 5:
    //             $select = 'updated_at';
    //             $order = 'desc';
    //             break;
    //         case 6:
    //             $select = 'updated_at';
    //             $order = 'asc';
    //             break;
    //     }
    //
    //     //検索
    //     $communitys = Community::query()
    //         ->select('id','community_name','community_image','community_members','created_at','updated_at')
    //         ->where('community_name', 'LIKE', "%{$request->community_name}%")
    //         ->orderBy($select, $order)
    //         ->simplePaginate(100);
    //
    //     $my_community = \DB::table('user_community')
    //         ->select('community_id')
    //         ->where('user_id',Auth::user()->id)
    //         ->get();
    //
    //     $my_communitys = [];
    //     foreach($my_community as $id){
    //         array_push($my_communitys,$id->community_id);
    //     }
    //
    //     return view('matching.search_community',compact('communitys','my_communitys'));
    // }

    public function verify_community($community_id)
    {
        $community = \DB::table('community')
            ->select('id','community_name','community_comment','community_image')
            ->where('id',$community_id)
            ->first();

        $community_flag = \DB::table('community')
            ->select('interface_flag','voicechat_flag','serve_flag',
                      'rank_flag','level_flag','play_time_flag')
            ->where('id',$community_id)
            ->first();

        return view('matching.verify_community',compact('community','community_flag'));
    }

    public function matched_community(Request $request)
    {

        $request->validate([
            'interface' => 'max:255',
            'voicechat' => 'max:255',
            'serve' => 'max:255',
            'rank' => 'max:255',
            'interface_flag' => 'max:255',
            'voicechat_flag' => 'max:255',
            'serve_flag' => 'max:255',
            'rank_flag' => 'max:255',
            'level_flag' => 'max:255',
            'play_time_flag' => 'max:255'
        ]);

        $user_community= new UserCommunity();
        $user_community->fill([
              'user_id' => (int)Auth::user()->id,
              'community_id' => (int)$request->community_id,
              'interface' => $request->interface,
              'voicechat' => $request->voicechat,
              'serve' => $request->serve,
              'interface' => $request->interface_flag,
              'voicechat' => $request->voicechat_flag,
              'serve' => $request->serve_flag,
              'rank' => $request->rank_flag,
              'level' => $request->level_flag,
              'play_time' => $request->play_time_flag,
        ]);
        $user_community->save();

        $add_community_member = Community::where('id', $request->community_id)->first();
        $add_community_member->community_members++;
        $add_community_member->save();

        $community = \DB::table('community')
            ->select('id','community_name','community_image')
            ->where('id',$request->community_id)
            ->first();

        return view('matching.matched_community',compact('community'));
    }

    public function now_community()
    {
        $communitys = UserCommunity::query()
            ->join('community','community.id','=','user_community.community_id')
            ->join('users','users.id','=','user_community.user_id')
            ->select('community.id','community.community_name','community.community_image',
            'community.community_members','community.created_at','community.updated_at')
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

        //チェックボックス用のvalue判定($requestがnullのとき0を返す)
        function checkbox_fill($request_val){
            if(!isset($request_val)){
                return 0;
            }else{
                return 1;
            }
        }

        //コミュニティ名だけinsertしてidを生成
        $community->fill([
            'community_name' => $request->community_name,
            'community_comment' => $request->community_comment,
            'community_members' => 0,
            'interface_flag' => checkbox_fill($request->interface),
            'voicechat_flag' => checkbox_fill($request->voicechat),
            'serve_flag' => checkbox_fill($request->serve),
            'rank_flag' => checkbox_fill($request->rank),
            'level_flag' => checkbox_fill($request->level),
            'play_time_flag' => checkbox_fill($request->play_time),
            'user_id' => Auth::user()->id
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
        $send_friends = \DB::table('friend')
            ->join('users','friend.post_user_id','=','users.id')
            ->select('users.id','users.name','users.last_login_at')
            ->where('friend.send_user_id',Auth::user()->id)
            ->where('friend.status',1)
            ->get();

        $post_friends = \DB::table('friend')
            ->join('users','friend.send_user_id','=','users.id')
            ->select('users.id','users.name','users.last_login_at')
            ->where('friend.post_user_id',Auth::user()->id)
            ->where('friend.status',1)
            ->get();


        $friend_request = \DB::table('friend')
            ->join('users','friend.post_user_id','=','users.id')
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


        return view('matching.friend',compact('send_friends','post_friends','friend_request','post_request'));
    }

    public function friend_check(Request $request)
    {
        $update_friend_status = Friend::where('post_user_id',$request->user_id)
            ->where('send_user_id',Auth::user()->id)
            ->where('status',0)
            ->first();
        $update_friend_status->status = 1;
        $update_friend_status->save();

        return redirect()->route('friend');
    }

    public function friend_delete(Request $request)
    {
        Friend::where('post_user_id',Auth::user()->id)
            ->where('send_user_id',$request->id)
            ->delete();

        Friend::where('send_user_id',Auth::user()->id)
            ->where('post_user_id',$request->id)
            ->delete();

        return redirect()->route('friend');
    }

    public function mypage()
    {
        $user_game_account = GameAccount::where('user_id', Auth::user()->id)
        ->orderBy('id', 'asc')->get();
        return view('matching.mypage',compact('user_game_account'));
    }

    public function edit_mypage()
    {
        $user_game_account = GameAccount::where('user_id', Auth::user()->id)
        ->orderBy('id', 'asc')->get();
        return view('matching.edit_mypage',compact('user_game_account'));
    }

    public function update_mypage(Request $request)
    {
        $request->validate([
            'name' => 'max:255',
            'age' => 'max:255',
            'sex' => 'max:255',
            'sns' => 'max:255',
            'url' => 'max:255',
            'profile' => 'max:255',
            'game_hard1' => 'max:255',
            'game_hard2' => 'max:255',
            'game_hard3' => 'max:255',
            'account1' => 'max:255',
            'account2' => 'max:255',
            'account3' => 'max:255'
        ]);

        $image;
        $file_path = $request->file('image');

        //画像の名前はuser_id.jpg、画像が存在しないときは今の画像を持ってくる
        if(file_exists($file_path)){
              $user_image_name = Auth::user()->id.'.jpg';
              $image_key = Storage::disk('s3')->putFileAs('/users',$file_path,$user_image_name,'public');
              Log::debug("ok*********************************");
              $image = Storage::disk('s3')->url($image_key);
        }else{
              $image = Auth::user()->user_image;
        }

        $user = User::where('id', Auth::user()->id)->first();

        $user->name = $request->name;
        $user->age = $request->age;
        $user->sex = $request->sex;
        $user->sns = $request->sns;
        $user->url = $request->url;
        $user->profile = $request->profile;
        $user->user_image = $image;
        $user->save();


        $user_game_account = GameAccount::where('user_id', Auth::user()->id)
        ->orderBy('id', 'asc')->get();
        for($i = 0;$i <= 2;$i++){
            $user_game_account[$i]->game_hard = $request->{'game_hard'.$i};
            $user_game_account[$i]->account = $request->{'account'.$i};
            $user_game_account[$i]->timestamps = false;
            $user_game_account[$i]->save();
        }

        return redirect()->route('mypage')->with('flash_message', '編集が完了しました');
    }

    public function userpage($user_id)
    {
        $post_bool = \DB::table('friend')
            ->where('post_user_id', $user_id)
            ->where('send_user_id', Auth::user()->id)
            ->where('status', 1)
            ->exists();

        $send_bool = \DB::table('friend')
            ->where('send_user_id', $user_id)
            ->where('post_user_id', Auth::user()->id)
            ->where('status', 1)
            ->exists();

        if($post_bool or $send_bool){

            $user = \DB::table('users')
                ->select('id','name','age','sex','profile','user_image','sns','url')
                ->where('id',$user_id)
                ->first();

            $user_game_account = GameAccount::where('user_id', $user_id)
                ->orderBy('id', 'asc')->get();

            $user_community = \DB::table('user_community')
                ->join('community','user_community.community_id','=','community.id')
                ->select('community.id','community.community_name','community.community_image','community.community_members')
                ->where('user_community.user_id',$user_id)
                ->get();

            $my_community = \DB::table('user_community')
                ->select('community_id')
                ->where('user_id',Auth::user()->id)
                ->get();

            $my_communitys = [];
            foreach($my_community as $id){
                array_push($my_communitys,$id->community_id);
            }
        }else{
            return back()->with('flash_message', 'フレンド登録が完了していないためユーザーページが見れません');
        }

        return view('matching.userpage',compact('user','user_community','my_communitys','user_game_account'));
    }

}
