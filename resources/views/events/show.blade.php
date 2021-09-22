@extends('layouts.app')

@section('content')
<div class="container">

<div class="d-flex">  
    <div class="col-3">
        <a href="/profile/{{$event->user->id}}">
            <img src="{{ $event->user->profile->profileImage()}}" class="rounded-circle w-100 img-thumbnail">
            <h5 class=" text-center mt-2">{{$event->user->profile->username}}</h5>
        </a>

        <favorite
        :event-id="{{ json_encode($event->id) }}"
        :user-id="{{ json_encode($authUser->id) }}"
        :default-Liked="{{ json_encode($defaultLiked) }}"
        class="mt-2">
        </favorite>
    </div>

    


    <div class="col-6">
        <img src="/storage/{{$event->image}}" class="w-75 h-75">
        <h5>{{$event->title}}</h5>
        @if($event->start != $event->end)
        <small>{{$event->start}}~{{$event->end}}</small>
        @else
        <small>{{$event->start}}</small>
        @endif
        <p>{{$event->details}}</p>
        
        @if($event->url)
        <p>URL : <a href="{{$event->url}}">{{$event->url}}</a></p>
        @endif
    </div>
</div>
    
    @can('update', $event->user->profile)
    <a href="/event/{{$event->id}}/delete">Delete</a>
    <br>
    <a href="/event/{{$event->id}}/edit">Edit</a> 
    @endcan
    
</div>

@endsection