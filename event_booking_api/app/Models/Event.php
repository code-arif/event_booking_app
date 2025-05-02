<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //relaiton with booking table
    public function booking(){
        return $this->hasMany(Booking::class);
    }

    protected $fillable = [
        'title', 'description', 'ticket_price', 'start_date', 'end_date'
    ];
}
