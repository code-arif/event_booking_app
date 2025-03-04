<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //relaiton with booking table
    public function booking(){
        return $this->hasMany(Booking::class);
    }
}
