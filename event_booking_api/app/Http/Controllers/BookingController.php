<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

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
}
