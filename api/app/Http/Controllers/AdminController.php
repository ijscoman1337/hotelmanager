<?php

namespace App\Http\Controllers;
use App\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 3. De gegevens van de reservering moeten worden opgeslagen en kunnen worden terug
    //gelezen door een administrator van het systeem.

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function getReservation(Request $request){
        /** @var Reservation $reservation */
        $reservation = Reservation::find($request->get("reservation_id"));
        return response()->json([
            'result' => $reservation,
        ], 201);
    }

    //4. De reservering kan worden bevestigd of worden afgewezen door de administrator.
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function confirmreservation(Request $request){
        /** @var Reservation $reservation */
        $reservation = Reservation::find($request->get("reservation_id"));
        //TODO: would probably be nice to use an Enum for this somehow
        // 0 = not processed 1 = confirmed 2 = denied
        $reservation->admin_confirmed = $request->get('confirm') ? 1 : 2;
        $reservation->save();
        //3. De bevestiging na de reservering bevat een factuur opgemaakt in PDF.
        //TODO: there's two ways we can do this. We can either refer to a helper class directly from here, but
        //a more elegant solution would probably be to listen to one of the lifecycle events from Eloquent to
        //trigger the appropiate method in aforementioned helper class so we make this event as reusable as we possibly can

        return response()->json([
            'message' => "reservation was " . ($reservation->admin_confirmed === 1 ? 'confirmed' : 'denied')
        ], 201);
    }
}
