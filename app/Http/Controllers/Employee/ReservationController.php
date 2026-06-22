<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;
use App\Models\Building;
use App\Models\Equipement;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $buildings = Building::with('rooms')->has('rooms')->get();
        $equipements = Equipement::with('rooms')->has('rooms')->get();

        $roomsQuery = Room::query()->where("is_active", true)->with([
            'building',
             'equipements',
             'reservations'
        ]);

        $building_id = $request->building_id;
        $date = $request->date;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $capacity = $request->capacity;
        $equipementIds = $request->equipements;

        if(!empty($building_id)){
            $roomsQuery->where('building_id',$building_id);
        }

         if(!empty($capacity)){
            $roomsQuery->where('capacity',$capacity);
        }

        if (!empty($equipementIds)) {
            $roomsQuery->whereHas('equipements', function ($query) use ($equipementIds) {
             $query->whereIn('equipement_id', $equipementIds);
        });
        }
        

        $rooms = $roomsQuery->get();

        return view('employee.index', compact('buildings', 'rooms', 'equipements'));


    }

    public function reserver($room_id)
    {
        $room = Room::findOrFail($room_id);
        return view('employee.createReserve', compact('room'));
    }

    public function storeReservation(StoreReservationRequest $request)
    {
        Reservation::create([
            'start_datetime' =>   $request->date." " . $request->start_time,
            'end_datetime' => $request->date ." ". $request->end_time,
            'notes' => $request->notes,
            'room_id' => $request->room_id,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('employee.reservations');

    }

    public function updateReservation(UpdateReservationRequest $request)
    {

        Reservation::update([
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => $request->status,
            'notes' => $request->notes,
            'room_id' => $request->room_id,
            'user_id' => auth()->id()

        ]);

        return redirect()->route('employee.reservations');

    }

    public function reservationHistories()
    {

        $pending = auth()->user()->reservation()->where('status', 'pending')->get();
        $confirmed = auth()->user()->reservation()->where('status', 'confirmed')->get();
        $cancelled = auth()->user()->reservation()->where('status', 'cancelled')->get();

        return view('employee.showHistoriques', compact('pending', 'confirmed', 'cancelled'));
    }

    public function annulerReserve($id)
    {
        $reserver = Reservation::findOrFail($id);

        $reserver->update([
            'status' => 'cancelled',
        ]);

        return back();

    }

    public function forForbiddenInTheSameTime(Request $request,$id){
        $room_id = Room::findOrFail($id);
        $date = $request->date;
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        if($date <=  now()){
            return back()->with('error',"Invalide start time You should to be less then end time");
        }
        if(!Reservation::where("start_datetime",">",now())->where("room_id",$room_id)){
            // storeReservation
        }
        else{
            if(!Reservation::where("start_datetime", $date)){
                    // storeReservation
            }
            else{
                if(!Reservation::where("status" , "confirmed")->where("start_datetime", "<=", $startTime)->orWhere("end_datetime", ">=" ,$endTime)){
                    // storeReservation
                }
                else{
                     return back()->with("error","The booking has been made at this time");
                }
            }
        }

        

    }




}
