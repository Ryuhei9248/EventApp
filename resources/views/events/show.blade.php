@extends('layouts.app')

@section('content')
<div class="container">

<div class="d-flex">  
    <div class="col-3">
        <img src="{{ $event->user->profile->profileImage()}}" class="rounded-circle w-100 img-thumbnail">
        <a href="/profile/{{$event->user->id}}">{{$event->user->profile->username}}</a>
    </div>
    


    <div class="col-6">
        <img src="/storage/{{$event->image}}" class="w-100 h-100">
        イベント名：{{$event->title}}<br>
        詳細：{{$event->details}}<br>
        開始日：{{$event->start}}
        終了日：{{$event->end}}<br>
        URL : {{$event->url}}
    </div>
</div>
    
    @can('update', $event->user->profile)
    <a href="/event/{{$event->id}}/delete">Delete</a>
    <br>
    <a href="/event/{{$event->id}}/edit">Edit</a> 
    @endcan
    
</div>

@endsection