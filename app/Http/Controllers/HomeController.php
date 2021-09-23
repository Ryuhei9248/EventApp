<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Profile;

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

        $users = Profile::whereIn('user_id', $followingProfile)->orderBy('id', 'desc')->get();
        $events = Event::whereIn('user_id', $followingProfile)->orderBy('id', 'desc')->get(); //profileのidとuser_idは同じであるため
        
        return view('home', compact('users','events'));
    }
}
