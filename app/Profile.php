<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profiles/fbZ27MKEDEK10GAJdjV9D2jzJeYqO3zIMCbHOfOD.jpg'; 
        return  '/storage/'. $imagePath; 
    }

    public function followers(){
        return $this->hasMany(Follow::class);
    }
}
