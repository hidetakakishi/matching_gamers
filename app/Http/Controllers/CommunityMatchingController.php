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

class CommunityMatchingController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $my_communitys = [];

        if(Auth::check()){
            $my_community = \DB::table('user_community')
                ->select('community_id')
                ->where('user_id',Auth::user()->id)
                ->get();

            foreach($my_community as $id){
                array_push($my_communitys,$id->community_id);
            }
        }

        $communitys = Community::query()
            ->select('id','community_name','community_image','community_members','created_at','updated_at')
            ->orderBy('community_members', 'desc')
            ->simplePaginate(12);

        return view('matching.matching_community',compact('communitys','my_communitys'));
    }

    public function search_community(Request $request)
    {
        $select;
        $order;
        $my_communitys = [];

        if(Auth::check()){
            $my_community = \DB::table('user_community')
                ->select('community_id')
                ->where('user_id',Auth::user()->id)
                ->get();

            foreach($my_community as $id){
                array_push($my_communitys,$id->community_id);
            }
        }

        switch ($request->select) {
            case 1:
                $select = 'community_members';
                $order = 'desc';
                break;
            case 2:
                $select = 'community_members';
                $order = 'asc';
                break;
            case 3:
                $select = 'created_at';
                $order = 'desc';
                break;
            case 4:
                $select = 'created_at';
                $order = 'asc';
                break;
            case 5:
                $select = 'updated_at';
                $order = 'desc';
                break;
            case 6:
                $select = 'updated_at';
                $order = 'asc';
                break;
        }

        //検索
        $communitys = Community::query()
            ->select('id','community_name','community_image','community_members','created_at','updated_at')
            ->where('community_name', 'LIKE', "%{$request->community_name}%")
            ->orderBy($select, $order)
            ->simplePaginate(100);

        return view('matching.search_community',compact('communitys','my_communitys'));
    }

}
