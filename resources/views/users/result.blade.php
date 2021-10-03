@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-4">
            <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
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
                                    <div class="d-flex">
                                        <img src="{{ $profile->image}}" class="rounded-circle" height="50" width="50">
                                        <p class="pl-3 overflow-hidden" style="white-space: nowrap; text-overflow: ellipsis;">{{$profile->username}}</p>
                                    </div>
                                </a>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="tab-pane fade" id="list-event" role="tabpanel" aria-labelledby="list-event-list">
                <h5>{{$message_event}}</h5>
                @if(isset($events))
                    <div class="d-flex flex-column overflow-auto mt-4">
                        <ul class="list-group" style="max-height: 600px;">
                            @foreach($events as $event)
                                <div class="list-group-item p-2 overflow-hidden" style="max-height: 90px;">
                                    <div class="d-flex">
                                        <img src="{{$event->image}}" width="75" height="75">
                                        
                                        <div class="d-flex flex-column">                                        
                                            <a href="/event/{{$event->id}}"><h5 class="pl-2">{{$event->title}}</h5></a>
                                            <p class="pl-2"　id="resultDetails" style="max-width: 80%;">{{$event->details}}</p>
                                        </div>

                                        <div class="ml-auto d-flex-column">
                                            <p class="text-right" style="min-width: 100px; position: absolute; top:10px; right: 10px;">by  <a href="/profile/{{$event->user->id}}">{{$event->user->profile->username}}</a></p>
                                            <p class="text-right small  text-muted mb-0" style="min-width: 70px; position: absolute; bottom: 0; right: 10px;">{{$event->created_at->diffForHumans()}}</p>
                                        </div>
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

@endsection