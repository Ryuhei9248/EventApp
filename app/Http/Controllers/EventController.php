<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\User;
use App\Event;
use Illuminate\Http\Request;


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

    public function create()
    {
        return view('events.create');
    }

    public function store()
    {   

        //dd(request()->start);
        $data = request()->validate([
            'title' => 'required',
            'image' => ['image', 'required'],
            'details' => '',
            'start'=> ['required','date_format:Y-m-d H:i:s'],
            'end'=> ['required','after:start','date_format:Y-m-d H:i:s'],
            'color' => 'required',
            'url' =>['url','nullable']            
        ]);


        $imagePath = request('image')->store('events', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        $imageArray = ['image' => $imagePath];

        auth()->user()->events()->create(array_merge(
            $data,
            $imageArray
        )); 

        return redirect('/profile/' . auth()->user()->id);
    }


    public function delete(Event $event)
    {
        $this->authorize('delete', $event);
        return view('events.delete',compact('event'));
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

    public function update(Event $event)
    {
        $this->authorize('update', $event);

        $data = request()->validate([
            'title' => 'required',
            'image' => ['image', 'required'],
            'details' => '',
            'start'=> 'required',
            'end'=> 'required',
            'url' =>['url', 'nullable'],
            'color' => 'required'
        ]);


        $imagePath = request('image')->store('events', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        $imageArray = ['image' => $imagePath];

        auth()->user()->events()->update(array_merge(
            $data,
            $imageArray
        )); 

        return redirect('/event/' . $event->id);
    }
}
