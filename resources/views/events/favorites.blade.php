@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justfy-content-center">
        <div id="calendar" class="w-50 mx-auto"></div>

        
        <div class="d-flex mt-5">
            @foreach($events as $event)
                <div class="col-3">
                    <div class="card mb-5">
                        <a href="/event/{{$event->id}}">
                            <img src="/storage/{{ $event -> image }}" class="bd-placeholder-img card-img-top" width="50%" height="200">
                            <h6 class="card-title pl-2 pt-1 mb-0">{{$event->title}}</h6>
                        </a>
                        
                        <a href="/profile/{{$event->user_id}}">
                            <p class="card-text mb-0 mr-1 text-right">by {{$event->user->profile->username}}</p>
                        </a>
                        <p class="card-text text-right mr-1"><small class="text-muted">{{$event->created_at->diffForHumans()}}</small></p>
                    </div>
                </div>
            @endforeach

            
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
                        color: '{{$event->color}}',
                    },
            @endforeach
                ],
      
          
        });
    calendar.render();
  });
</script>
@endsection
