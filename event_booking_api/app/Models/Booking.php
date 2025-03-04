<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //relation with user table
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relation with event table
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
