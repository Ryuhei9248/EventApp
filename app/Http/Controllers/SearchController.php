<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Event;

class SearchController extends Controller
{
    public function search(Request $request){

        $keyword = $request->keyword;

        if(empty($keyword)){
            return back();
        }
        
        $profiles = Profile::where('username','like', '%'.$keyword.'%')->get();
        $events = Event::where('title', 'like', '%'.$keyword.'%')->get();
        
        $empty_profiles = $profiles->isEmpty();
        $empty_events = $events->isEmpty();



        if($empty_profiles && $empty_events){
            //userとeventの検索結果が空だった場合
            $message_user = "No Such User";
            $message_event = "No Such Event";
            return view('users.result', compact('message_user', 'message_event'));

        }elseif(!$empty_profiles && $empty_events){
            //userのみ検索結果があった場合
            $count = $profiles->count();
            if($count == 1){
                $message_user = "1 User Found";
            }else{
                $message_user = "$count Users Found";
            }

            $message_event = "No Such Event";

            return view('users.result', compact('profiles', 'message_user', 'message_event'));

        }elseif($empty_profiles && !$empty_events){
            //eventのみ検索結果があった場合
            $count = $events->count();
            if($count == 1){
                $message_event = "1 Event Found";
            }else{
                $message_event = "$count Events Found";
            }

            $message_user = "No Such User";

            return view('users.result', compact('events', 'message_user', 'message_event'));

        }else{
            //どちらも検索結果があった場合
            $count_profiles = $profiles->count();
            if($count_profiles == 1){
                $message_user = "1 User Found";
            }else{
                $message_user = "$count_profiles Users Found";
            }
            $count_events = $events->count();
            if($count_events == 1){
                $message_event = "1 Event Found";
            }else{
                $message_event = "$count_events Events Found";
            }
            return view('users.result', compact('events', 'profiles','message_user', 'message_event'));
        }
}

}
