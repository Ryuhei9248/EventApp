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

        $followings = auth()->user()->followings->all();
        
        $followingProfile = array_column($followings, 'profile_id');

        $users = Profile::whereIn('user_id', $followingProfile)->orderBy('id', 'desc')->get();
        $events = Event::whereIn('user_id', $followingProfile)->orderBy('id', 'desc')->get(); //profileのidとuser_idは同じであるため

        if(empty($followings)){
            return view('home');
        }else{
            return view('home', compact('users','events'));
        }

 
    }
}
