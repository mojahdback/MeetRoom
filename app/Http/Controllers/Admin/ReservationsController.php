<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index(){

        $reservations = Reservation::all();

        return view('Reservation.reservations' , compact('reservations'));

    }

    public function confirmedReservation($id){
        $confirmed = Reservation::findOrFail($id);
        $confirmed->update([
                'status' => 'confirmed'
        ]);

        return back();


    }

     public function cancelledReservation($id){
        $cancelled = Reservation::findOrFail($id);
        $cancelled->update([
                'status' => 'cancelled'
        ]);

        return back();


    }


}
