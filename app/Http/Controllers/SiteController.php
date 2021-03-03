<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index(){

        $topics = Topic::all();
        $users_comments = Comment::where('status',1)->get();
        $auth = Auth::user();
//        dd($users_comments);
        return view('home',['topics'=>$topics,'users_comments'=>$users_comments,'auth'=>$auth]);


    }
}
