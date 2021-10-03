@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Favorited Events</h1>
    <div class="d-flex">
        <div class="col-7">
            <div id="calendar" class="mx-auto"></div>
        </div>
        
        <div class="col-5 overflow-auto" style="max-height: 535px;">
            <div class="row mt-2">
                @foreach($events as $event)
                    <div class="col-6">
                        <div class="card mb-3">
                            <img src="{{ $event -> image }}" class="bd-placeholder-img card-img-top h-50">
                            <a href="/event/{{$event->id}}">
                                <h5 class="card-title pl-2 pt-1 mb-0 overflow-hidden" style="white-space: nowrap; text-overflow: ellipsis;">{{$event->title}}</h5>
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
