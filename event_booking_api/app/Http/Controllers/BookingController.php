<?php

namespace App\Http\Controllers;

use App\Events\BookingStatusUpdateNotification;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    //get all bookings
    public function getAllBookings(){
        $bookings = Booking::with(['user', 'event'])->get();
        return response()->json([
            'message' => 'Bookings retrieved successfully',
            'data' => $bookings,
        ]);
    }

    //create booking
    public function createBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'event_id' => 'required',
            'ticket_qty' => 'required'
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

        $event = Event::where('id', $request->event_id)->first();

        $booking = Booking::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'ticket_qty' => $request->ticket_qty,
            'total_price' => $request->ticket_qty * $event->ticket_price,
            'status' => 'pending'
        ]);

        return response()->json(
            [
                'status' => true,
                'message' => 'Event successfully booked! thank you.',
                'data' => $booking,
            ],
            200,
        );
    }

    //get siggel memerb bookings
    public function getMemberBookings(Request $request){
        $bookings = Booking::with(['user', 'event'])->where('user_id', $request->id)->get();

        if(!$bookings){
            return response()->json([
                'status' => false,
                'message' => 'No bookings found!'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Bookins render successfully',
            'data' => $bookings
        ]);
    }

    //booking by id
    public function getBookingById(Request $request){
        $booking = Booking::with(['user', 'event'])->where('id', $request->id)->first();
        return response()->json([
            'message' => 'Bookings retrieved',
            'data' => $booking,
        ]);
    }

    //change booking status
    public function changeBookingStatus(Request $request){
        $validator = Validator::make($request->all(), [
            'status' => 'required',
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

        $booking = Booking::findOrFail($request->id);

        $booking->update($request->all());
        $bookingData = Booking::with(['user', 'event'])->where('id', $request->id)->first();
        
        event(new BookingStatusUpdateNotification($bookingData));

        return response()->json(
            [
                'status' => true,
                'message' => 'Status updated successfully',
                'data' => $booking->status
            ],
            200,
        );
    }
}
