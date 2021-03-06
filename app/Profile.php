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


    public function followers(){
        return $this->hasMany(Follow::class);
    }
}
