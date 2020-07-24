<?php

namespace App\Http\Controllers;
use App\Article;
use App\Reservation;
use App\Room;
use DateTime;
use Exception;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    // 1. De applicatie moet een landingspagina hebben waarop het hotel wordt ingeleid.
    // In other words: get the article with all its paragraphs and return it in JSON

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    function getHomepage(){
        $articles = Article::with('paragraphs')
            ->where('page','home')
            ->get();

        return response()->json([
            'articles' => $articles,
        ]);
    }

    // 2. Op de reserveringspagina moet de klant zijn naam, emailadres, geboortedatum,
    // telefoonnummer (optioneel), aantal personen en gewenste datum en eventuele
    // opmerkingen invullen.

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function makeReservation(Request $request){

        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'date_birth' => 'required|date_format:Y-m-d|before:today',
            'phone' => 'required|string',
            'date_checkin' => 'required|date_format:Y-m-d|after_or_equal:today',
            'date_checkout' => 'required|date_format:Y-m-d|after:date_checkin',
            'people_count' => 'required|integer',
            'remarks' => 'required|string',
            'room_id' => 'integer',
        ]);

        // we change it to a datetime once here to check the difference in nights,
        // then we change the same variables back to a mySQL compatible format (also the way we are storing dates)
        $date_checkin = new DateTime($request->date_checkin);
        $date_checkout = new DateTime($request->date_checkout);
        $nights = $date_checkout->diff($date_checkin)->d - 1;

        $date_checkin = $date_checkin->format("Y-m-d H:i:s");
        $date_checkout = $date_checkout->format("Y-m-d H:i:s");

        if($nights < 1){
            throw new Exception("It appears you are trying to make a reservation for 0 nights");
        }

        // TODO: figure out how to retrieve user id from session if available

        $newReservation = new Reservation([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'date_birth' =>$request->date_birth,
            'phone' => $request->phone,
            'date_checkin' => $date_checkin,
            'date_checkout' => $date_checkout,
            'people_count' => $request->people_count,
            'nights_count' => $nights,
            'remarks' => $request->remarks,
        ]);

        // if a room id came with this request, there is a couple of things we must check before we can actually justify
        // adding the given room to the reservation
        if($request->room_id){
            $reservations = Reservation::where('room_id', '=', $request->room_id)->get();
            foreach ($reservations as $reservation){
                if(
                    !($newReservation->date_checkin >= $reservation->date_checkout) ||
                    !($newReservation->date_checkout <= $reservation->date_checkout)
                ) {
                    throw new Exception(
                        'It seems that your reservation is overlapping one or more reservations on this room'
                    );
                }
            }
            $newReservation->room_id = $request->room_id;
        }

        $newReservation->save();

            return response()->json([
                'message' => 'Successfully created reservation!',
            ], 201);
    }


}
