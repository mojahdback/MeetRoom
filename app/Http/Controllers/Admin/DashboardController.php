<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Equipement;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $buildings = Building::count();
        $rooms = Room::count();
        $equipements = Equipement::count();
        $reservations = Reservation::count();
        return view('admin.Dashboard.index', compact('buildings', 'rooms', 'equipements', 'reservations'));

    }

    public function roomsOfEachBuilding()
    {
        $buildings = DB::table('buildings as b')
            ->leftJoin('rooms as r', 'b.id', '=', 'r.building_id')
            ->select('b.name', DB::raw('COUNT(r.id) as totalRooms'))
            ->groupBy('b.id', 'b.name')
            ->get();

        return response()->json($buildings); 

    }

    public function tauxDoccupation()
    {
        $tauxOccupation = DB::table('buildings as b')
            ->leftJoin('rooms as rm', 'rm.building_id', '=', 'b.id')
            ->leftJoin('reservations as rs', function ($join) {
                $join->on('rs.room_id', '=', 'rm.id')
                    ->where('rs.status', 'confirmed')
                    ->whereDate('rs.start_datetime', today());
            })
            ->select(
                'b.name as buildingName',
                DB::raw("
            ROUND(
                COUNT(DISTINCT rs.room_id) * 100 /
                NULLIF(COUNT(DISTINCT rm.id), 0),
                2
            ) as tauxDoccupation
        ")
            )
            ->groupBy('b.id', 'b.name')
            ->get();

             return response()->json($tauxOccupation);
    }



}
