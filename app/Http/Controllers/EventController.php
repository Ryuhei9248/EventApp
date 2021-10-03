<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\User;
use App\Event;
use Illuminate\Http\Request;
use App\Favorite;


class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Event $event)
    {
        $authUser = auth()->user();
        $event->load('favorites');
        $defaultFavorite = $event->favorites->where('user_id', $authUser->id)->first();
        
        if(empty($defaultFavorite)){
            $defaultLiked = false;
        }else{
            $defaultLiked = true;
        }
        //dd($defaultLiked);
        return view('events.show', compact('event', 'authUser', 'defaultLiked'));
    }

    public function index()
    {
        $favorites = auth()->user()->favorites->all();
        
        $favoriteEvents = array_column($favorites, 'event_id');
        
        $events = Event::whereIn('id', $favoriteEvents)->orderBy('id', 'desc')->get();
        return view('events.favorites', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {   

        $data = request()->validate([
            'title' => 'required',
            'image' => ['image', 'required'],
            'start'=> ['required','date_format:Y-m-d\TH:i'],
            'end'=> ['required','after:start','date_format:Y-m-d\TH:i'],
            'details' => '',
            'url' =>['url','nullable'],
            'color' => 'required',         
        ]);


        // $imagePath = request('image')->store('events', 'public');
        // $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        // $image->save();
        $imagePath = Image::make(file_get_contents($request->image->getRealPath()))->fit(1200,1200);
        $image = 'data:image/png;base64,'. base64_encode($imagePath->encode('png'));

        $imageArray = ['image' => $image];

        auth()->user()->events()->create(array_merge(
            $data,
            $imageArray
        )); 

        return redirect('/profile/' . auth()->user()->id);
    }

    public function remove(Event $event)
    {
        $this->authorize('delete', $event);
        $event->delete();
        
        return redirect('/profile/' . auth()->user()->id);
    }

    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        return view('events.edit',compact('event'));
    }

    public function update(Event $event, Request $request)
    {
        $this->authorize('update', $event);

        $data = request()->validate([
            'title' => 'required',
            'image' => ['image','required'],
            'start'=> ['date_format:Y-m-d\TH:i', 'required'],
            'end'=> ['after:start','date_format:Y-m-d\TH:i', 'required'],
            'details' => '',
            'url' =>['url', 'nullable'],
            'color' => 'required'
        ]);


        // $imagePath = request('image')->store('events', 'public');
        // $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        // $image->save();

        $imagePath = Image::make(file_get_contents($request->image->getRealPath()))->fit(1200,1200);
        $image = 'data:image/png;base64,'. base64_encode($imagePath->encode('png'));
        $imageArray = ['image' => $image];

        auth()->user()->events()->update(array_merge(
            $data,
            $imageArray
        )); 

        return redirect('/event/' . $event->id);
    }
}
