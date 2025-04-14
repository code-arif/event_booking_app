<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //get all events
    public function getAllEvents(){
        $events = Event::get();
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $events
        ], 200);
    }
}
