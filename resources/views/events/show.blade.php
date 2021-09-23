@extends('layouts.app')

@section('content')
<div class="container">

<div class="d-flex">  
    <div class="col-3">
        <a href="/profile/{{$event->user->id}}">
            <img src="{{ $event->user->profile->profileImage()}}" class="rounded-circle w-100 img-thumbnail">
            <h5 class=" text-center mt-2">{{$event->user->profile->username}}</h5>
        </a>
    </div>

    


    <div class="col-6">
        <img src="/storage/{{$event->image}}" class="w-75 h-75">
        <h5>{{$event->title}}</h5>

        <favorite
        :event-id="{{ json_encode($event->id) }}"
        :user-id="{{ json_encode($authUser->id) }}"
        :default-Liked="{{ json_encode($defaultLiked) }}"
        class="mt-2">
        </favorite>
        
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
    <form action="/event/{{$event->id}}/remove" method="post">
        @csrf
        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg>Delete
        </button>
    </form>
    
    
    <form action="/event/{{$event->id}}/edit" method="get">
        @csrf
        <button class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>Edit
        </button>
    </form>
    @endcan
    
</div>

@endsection

@section('javascript')

@endsection