@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justfy-content-center">
        <div class="d-flex">
            <div class="col-3">
                <h3>Followings</h3>
                <div class="d-flex flex-column overflow-auto mt-4">
                    <ul class="list-group" style="max-height: 440px">
                    @if(isset($users))
                        @foreach($users as $user)
                            <a class="list-group-item p-2" href="/profile/{{$user->id}}" style="font-size: 1.2rem; max-height: 55px;">
                                <div class="d-flex">
                                    <img src="{{$user->profile->image}}" class="rounded-circle" height="30" width="30">
                                    <p class="pl-3 mb-0  overflow-hidden" style="white-space: nowrap; text-overflow: ellipsis;">{{$user->username}}</p>
                                </div>
                            </a>
                        @endforeach
                    @else
                    <div class="list-group-item p-2" style="font-size: 1.2rem; max-height: 55px;">
                        <p class="text-center m-auto">Not Following Anyone</p>
                    </div>
                    @endif
                    </ul>
                </div>
            </div>

            <div class="col-8">

                <div id="calendar" class="w-100 mx-auto"></div>

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
          @if(isset($events))
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
            @endif
                ],
      
          
        });
    calendar.render();
  });
</script>
@endsection
