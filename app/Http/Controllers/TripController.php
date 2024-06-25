<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    //Add Trip Function
    public function addTrip(TripRequest $tripRequest)
    {
        Trip::create([
            'created_by' => Auth::guard('user')->user()->id,
            'food_id' => $tripRequest->food_id,
            'p_type_id' => $tripRequest->p_type_id,
            'bus_name' => $tripRequest->bus_name,
            'departure' => $tripRequest->departure,
            'destination' => $tripRequest->destination,
            'departure_date' => $tripRequest->departure_date,
            'number_of_seats' => $tripRequest->number_of_seats,
            'fare' => $tripRequest->fare,
        ]);

        return success(null, 'this trip added successfully', 201);
    }

    //Edit Trip Function
    public function editTrip(Trip $trip, TripRequest $tripRequest)
    {
        $trip->update([
            'food_id' => $tripRequest->food_id,
            'p_type_id' => $tripRequest->p_type_id,
            'bus_name' => $tripRequest->bus_name,
            'departure' => $tripRequest->departure,
            'destination' => $tripRequest->destination,
            'departure_date' => $tripRequest->departure_date,
            'number_of_seats' => $tripRequest->number_of_seats,
            'fare' => $tripRequest->fare,
        ]);

        return success(null, 'this trip updated successfully');
    }

    //Delete Trip Function
    public function deleteTrip(Trip $trip)
    {
        $trip->delete();

        return success(null, 'this trip deleted successfully');
    }

    //Get Trips Function
    public function getTrips()
    {
        $trips = Trip::with('user', 'food', 'payType')->get();

        return success($trips, null);
    }

    //Get Trip Information Function
    public function getTripInformation(Trip $trip)
    {
        return success($trip->with('user', 'food', 'payType')->find($trip->id), null);
    }
}
