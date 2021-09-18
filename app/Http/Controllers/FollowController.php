<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use App\Profile;

class FollowController extends Controller
{
    public function follow(Profile $profile, Request $request){

        $follow = Follow::create(['profile_id' => $profile->id, 'user_id' => $request->user_id]);

        return response()->json([]);
    }

    public function unfollow(Profile $profile, Request $request){

        $follow = Follow::where('user_id', $request->user_id)->where('profile_id', $profile->id)->first();
        $follow->delete();

       
        return response()->json([]);
    }
}
