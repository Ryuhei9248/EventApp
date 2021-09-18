<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

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
    public function index()
    {
        $following = auth()->user()->followings->all();
        
        $followingProfile = array_column($following, 'profile_id');
        $posts = Post::whereIn('user_id', $followingProfile)->orderBy('id', 'desc')->get();
        return view('home', compact('posts'));
    }
}
