<?php

namespace App\Http\Controllers;
use App\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 3. De gegevens van de reservering moeten worden opgeslagen en kunnen worden terug
    //gelezen door een administrator van het systeem.
    function getReservation(Request $request){
        $reservation = Reservation::where('id', '=', 19)->first();
        return response()->json([
            'message' => 'getreservation method in Admincontroller',
            'data' => $reservation,
            'id' => $request->reservation_id
        ], 201);
    }
}
