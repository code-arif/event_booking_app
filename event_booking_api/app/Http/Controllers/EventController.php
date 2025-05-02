<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    //get a single event
    public function getEvent(Event $event){
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $event
        ], 200); 
    }

    //event update
    public function updateEvent(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'ticket_price' => 'nullable',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'error' => $validator->messages(),
                ],
                422,
            );
        }

        $event = Event::findOrFail($request->id);

        $event->update($request->all());

        return response()->json(
            [
                'status' => true,
                'message' => 'Event updated successfully',
                'data' => $event
            ],
            200,
        );
    }
}
