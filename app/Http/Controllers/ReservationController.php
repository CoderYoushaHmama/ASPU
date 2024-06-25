<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Http\Requests\SeatRequest;
use App\Models\Reservation;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //Add Reservation Function
    public function addReservation(ReservationRequest $reservationRequest, SeatRequest $seatRequest)
    {
        $reservation = Reservation::create([
            'created_by' => Auth::guard('user')->user()->id,
            'trip_id' => $reservationRequest->trip_id,
            'reservation_date' => $reservationRequest->reservation_date,
            'passenger_email' => $reservationRequest->passenger_email,
            'passenger_phone_number' => $reservationRequest->passenger_phone_number,
            'passenger_name' => $reservationRequest->passenger_name,
        ]);

        Seat::create([
            'created_by' => $reservation->created_by,
            'reservation_id' => $reservation->id,
            'seat_number' => $seatRequest->seat_number,
        ]);

        return success(null, 'this reservation added successfully', 201);
    }

    //Edit Reservation Function
    public function editReservation(Reservation $reservation, ReservationRequest $reservationRequest, SeatRequest $seatRequest)
    {
        $reservation->update([
            'trip_id' => $reservationRequest->trip_id,
            'reservation_date' => $reservationRequest->reservation_date,
            'passenger_email' => $reservationRequest->passenger_email,
            'passenger_phone_number' => $reservationRequest->passenger_phone_number,
            'passenger_name' => $reservationRequest->passenger_name,
        ]);

        $reservation->seat->update([
            'seat_number' => $seatRequest->seat_number,
        ]);

        return success(null, 'this reservation updated successfully');
    }

    //Delete Reservation Function
    public function deleteReservation(Reservation $reservation)
    {
        $reservation->delete();

        return success(null, 'this reservation deleted successfully');
    }

    //Get Reservation Function
    public function getReservations()
    {
        $reservations = Reservation::with('createdBy', 'trip', 'seat')->get();

        return success($reservations, null);
    }

    //GEt Reservation Information Function
    public function getReservationInformation(Reservation $reservation)
    {
        return success($reservation->with('createdBy', 'trip', 'seat')->find($reservation->id), null);
    }
}
