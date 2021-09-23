@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-user-list" data-toggle="list" href="#list-user" role="tab" aria-controls="user">Users</a>
            <a class="list-group-item list-group-item-action" id="list-event-list" data-toggle="list" href="#list-event" role="tab" aria-controls="event">Events</a>
            </div>
        </div>

        <div class="col-8">
            <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-user" role="tabpanel" aria-labelledby="list-user-list">
                <h5>{{$message_user}}</h5>
                @if(isset($profiles))
                    <div class="d-flex flex-column overflow-auto mt-4">
                        <ul class="list-group" style="max-height: 600px;">
                        @foreach($profiles as $profile)
                            <a href="/profile/{{$profile->id}}" class="list-group-item p-2" style="font-size: 2rem; max-height: 70px;">
                                <img src="{{ $profile->profileImage()}}" class="rounded-circle" height="50" width="50">
                                <span class="pl-3">{{$profile->username}}</span>
                            </a>
                        @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="tab-pane fade" id="list-event" role="tabpanel" aria-labelledby="list-event-list">
                <h5>{{$message_event}}</h5>
                @if(isset($events))
                <div class="d-flex flex-column overflow-auto mt-4">
                    <ul class="list-group" style="max-height: 600px;">
                        @foreach($events as $event)
                            <div href="/event/{{$event->id}}" class="list-group-item p-2">
                                <div class="d-flex">
                                    <img src="/storage/{{$event->image}}" width="75" height="75">
                                    
                                    <div class="d-flex flex-column">
                                        <a href="/profile/{{$event->user_id}}"><h5 class="pl-2">{{$event->user->profile->username}}</h5></a>
                                        <p class="pl-2">{{$event->details}}</p>
                                    </div>
                                        <small class="ml-auto">{{$event->created_at->diffForHumans()}}</small>
                                    
                                </div>
                                
                                
                            </div>
                        @endforeach 
                    </ul>
                </div>
                    
                @endif
            </div>
            </div>
        </div>
    </div>

</div>

@endsection