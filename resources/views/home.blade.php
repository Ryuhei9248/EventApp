@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            
                
        
                @foreach($posts as $post)
                <div class="card mb-5">
                <a href="/post/{{$post->id}}">
                    <img src="/storage/{{ $post -> image }}" class="bd-placeholder-img card-img-top" width="50%" height="500">
                </a>
                
                <a href="/profile/{{$post->user_id}}">
                    <h6 class="card-title pl-2 pt-1 mb-0">{{$post->user->profile->username}}</h6>
                </a>

                <p class="card-text mb-0 pl-2">{{$post->caption}}</p>
                <p class="card-text text-right mr-1"><small class="text-muted">{{$post->created_at}}</small></p>
                </div>
                @endforeach
            
            </div>
        </div>
    </div>
</div>
@endsection
