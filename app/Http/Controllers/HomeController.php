<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Reason;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $user = Auth::user();
//        dd(Auth::user());
        if ($user->role_id == 1){

            $all_users = User::where('id','!=',Auth::user()->id)->where('status',0)->get();
            $block_comments = Comment::where('status',2)->get();
            return view('site.admin',['all_users'=>$all_users,'block_comments'=>$block_comments]);

        }
        elseif ($user->role_id == 2){

            $comments = Comment::where('status',0)->get();
            $reasons = Reason::all();
            return view('site.moderator',['comments'=>$comments,'reasons'=>$reasons]);

        }
        else{

            $topics = Topic::all();
            $auth = Auth::user();
            $users_comments = Comment::where('user_id',Auth::user()->id)->get();
            return view('home',['topics'=>$topics,'users_comments'=>$users_comments,'auth'=>$auth]);

        }

    }
}
