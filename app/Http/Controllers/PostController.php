<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {   
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['image', 'required'],
        ]);


        $imagePath = request('image')->store('posts', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'] ,
            'image' => $imagePath,
        ]); 

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post)
    {
        $authUser = auth()->user();
        $post->load('likes');
        $defaultCount = count($post->likes);
        $defaultLiked = $post->likes->where('user_id', $authUser->id)->first();
        
        if(empty($defaultLiked)){
            $defaultLiked == false;
        }else{
            $defaultLiked == true;
        }

        return view('posts.show',compact('post', 'authUser', 'defaultLiked', 'defaultCount'));
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);
        return view('posts.delete',compact('post'));
    }

    public function remove(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        
        return redirect('/profile/' . auth()->user()->id);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit',compact('post'));
    }

    public function update(Post $post)
    {
        $this->authorize('update', $post);

        $data = request()->validate([
            'caption' => 'required',
            'image' => ['image', 'required'],
        ]);


        $imagePath = request('image')->store('posts', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        auth()->user()->posts()->update([
            'caption' => $data['caption'] ,
            'image' => $imagePath,
        ]); 

        return redirect('/post/' . $post->id);
    }
}
