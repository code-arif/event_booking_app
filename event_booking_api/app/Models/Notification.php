<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //relation with user table
    public function user(){
        return $this->belongsTo(User::class);
    }
}
