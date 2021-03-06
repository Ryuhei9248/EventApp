@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profile</h1>
    <div class="d-flex" style="margin-top: 30px">
        <div class="col-3 text-center">
            <img src="{{$user->profile->image ?? asset('img/icon.png')}}" class="rounded-circle w-100 mb-2 img-thumbnail">
            <h5>{{$user->profile->username}}</h5>
            <p style="white-space: pre-wrap;">{{$user->profile->description}}</p>

            @auth
                @if($authUser->id != $user->id)
                    <follow
                    :profile-id="{{ json_encode($user->profile->id) }}"
                    :user-id="{{ json_encode($authUser->id) }}"
                    :following="{{ json_encode($following)}}"
                    ></follow>
                @endif
            @endauth
            
            @can('update', $user->profile)
                    <a href="/profile/{{$user->id}}/edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        <span>Edit Profile</span>
                    </a>
            @endcan

            @can('update', $user->profile)
                    <div class="mt-1">
                        <a href="/event/create">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-plus" viewBox="0 0 16 16">
                            <path d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                            </svg>
                            <span>New Event</span>
                        </a>
                    </div>
            @endcan
        </div>
        
        <div class="col-8">
            <div id='calendar'></div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>

    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      displayEventTime: false,
      eventDisplay: 'block',
      events: [
          @foreach($events as $event)
                    {
                        id: '{{$event->id}}',
                        title: '{{$event->title}}',
                        start: '{{$event->start}}',
                        end: '{{$event->end}}',
                        url: '/event/{{$event->id}}',
                        color: '{{$event->color}}'
                    },
            @endforeach
                ],
      
          
        });
    calendar.render();
  });
</script>
@endsection