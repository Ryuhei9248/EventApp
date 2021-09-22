<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Favorite;

class FavoriteController extends Controller
{
    public function favorite(Event $event, Request $request){

        $favorite = Favorite::create(['user_id' => $request->user_id, 'event_id' => $event->id]);

        return response()->json();
    }

    public function unfavorite(Event $event, Request $request){

        $favorite = Favorite::where('user_id', $request->user_id)->where('event_id', $event->id)->first();
        $favorite->delete();
    
        return response()->json();
    }
}
