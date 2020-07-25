<?php

namespace App\Http\Controllers;
use App\Article;
use App\Reservation;
use App\Room;
use App\User;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Builder;
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
            //TODO: A more elegant way to do this is to figure out how to use eloquent to make a query for this
            foreach ($reservations as $reservation){
                if(
                    !($newReservation->date_checkin >= $reservation->date_checkout) ||
                    !($newReservation->date_checkout <= $reservation->date_checkout)
                ) {
                    $newReservation->admin_confirmed = 2;
                }
            }
            $newReservation->room_id = $request->room_id;

            $newReservation->price_total = $nights * Room::find($request->room_id)->price_per_night;
        }

        $newReservation->save();

        return response()->json([
            'message' => 'Successfully created reservation!',
        ], 201);
    }

    //5. De klant kan kiezen uit verschillende kamers.
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function getRooms(Request $request){

        $query = Room::query();
        // 1. De kamers zijn te filteren op het aantal personen en de datum die door de klant is
        // gekozen.
        if ($request->people_count) {
            $query = $query->where('people_count', $request->people_count);
        }

        if ($request->date_checkin && $request->date_checkout) {
            $query = $query->whereHas('reservations', function (Builder $query) use ($request) {

                $date_checkin = (new DateTime($request->date_checkin))->format("Y-m-d H:i:s");
                $date_checkout =(new DateTime($request->date_checkout))->format("Y-m-d H:i:s");
                $query->where('date_checkin', '>=', $date_checkout);
                $query->orWhere('date_checkout', '<=', $date_checkin);
            });
        }

        $results = $query->get();


        return response()->json([
            'data' => $results,
        ], 201);
    }

    // 2. De klant kan inloggen op de website van het hotel en kan zijn reserveringen inzien.
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function getReservationsByUser(Request $request){
        /** @var User $user */
        $user = $request->user();
        $reservations = Reservation::where('user_id', '=', $user->id)
            ->orWhere('email', '=', $user->email)
            ->get();

        return response()->json([
            'data' => $reservations,
            'email' => $user->email
        ], 201);
    }

}
