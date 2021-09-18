@extends('layouts.app')

@section('content')
<div class="container">

<div class="d-flex">  
    <div class="col-2">
        <div class="flex-column">
            <div class="w-50%">
                <a href="/profile/{{$post->user->id}}">
                    <img src="{{ $post->user->profile->profileImage()}}" class="rounded-circle img-thumbnail">
                </a>
            </div>
            <div class="pt-2">
                <a href="/profile/{{$post->user->id}}">
                    <p class="text-center">{{$post->user->profile->username}}</p>
                </a>    
            </div>
        </div>
    </div>
    


    <div class="col-6">
        <img src="/storage/{{$post->image}}" class="w-100">
        <p class="mt-1 h5">{{$post->caption}}</p>
        <div class="d-flex">
            <div class="flex-grow-1"> 
                <like
                    :post-id="{{ json_encode($post->id) }}"
                    :user-id="{{ json_encode($authUser->id) }}"
                    :default-Liked="{{ json_encode($defaultLiked) }}"
                    :default-Count="{{ json_encode($defaultCount) }}"
                    class="mt-2">
                </like>
            </div >
            <div class="p-2 flex-grow-1">
                <p class="text-right mt-3 mb-0"><small>{{$post->created_at}}</small></p>
            </div>
        </div>
    </div>
    
</div>
    @can('update', $post->user->profile)
    <a href="/post/{{$post->id}}/delete">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
        </svg>
        <span>Delete</span>
    </a>
    <br>
    <a href="/post/{{$post->id}}/edit">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
        </svg>
        <span>Edit</span>
    </a> 
    @endcan
</div>

@endsection