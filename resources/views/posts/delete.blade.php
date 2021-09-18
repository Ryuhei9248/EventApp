@extends('layouts.app')

@section('content')
<div class="container">

    <p>Are you sure?</p>
        <form action="/post/{{$post->id}}" method="get">
        @csrf
            <button class="btn btn-primary">No</button>
        </form>
        
        <form action="/post/{{$post->id}}/remove" method="post">
        @csrf
            <button class="btn btn-danger">Yes</button>
        </form>
    
</div>

@endsection