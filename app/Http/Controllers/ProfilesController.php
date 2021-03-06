<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Event;

class ProfilesController extends Controller
{
    public function index(User $user, Request $request)
    {
        $authUser = auth()->user();
        
        if($authUser){
            $following = $user->profile->followers->where('user_id', $authUser->id)->first();
            
            if(empty($following)){
                $following == false;
            }else{
                $following == true;
            }
            
        }else{
            $following = true;
        }
        
        $events = Event::where('user_id', $user->id)->get();

        return view('profiles/index', compact('user', 'authUser', 'following', 'events'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile); //policyでauthorizationを制限している。第一引数はアクション名、第二引数は関係するモデル

        return view('profiles.edit',compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'username' => 'required',
            'description' => '',
            'url' => ['url','nullable'],
            'image' => ['nullable', 'image'],
        ]);

        if(request('image')){
        
        $imagePath = Image::make(file_get_contents($request->image->getRealPath()))->fit(1000,1000);
        $image = 'data:image/png;base64,'. base64_encode($imagePath->encode('png'));
        $imageArray = ['image' =>$image];
        
        }
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        )); 

        return redirect("/profile/{$user->id}");
    }

}
