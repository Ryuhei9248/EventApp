<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\User;
use App\Event;
use Illuminate\Http\Request;
use App\Http\Resources\CalendarResource;

class EventController extends Controller
{
    public function index()
    {
        return CalendarResource::collection(Event::where('user_id', '1')->select('id','title', 'start','end','color')->get());         
    }

   
    public function create()
    {
        return view('events.create');
    }

    public function store()
    {   
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

        auth()->user()->events()->create(array_merge(
            $data,
            $imageArray
        )); 

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
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
