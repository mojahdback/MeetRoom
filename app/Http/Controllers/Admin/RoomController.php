<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipement;
use App\Models\Room;
use App\Models\Building;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buildings = Building::all();
        $equipements = Equipement::all();
        return view('admin.rooms.create', compact('buildings', 'equipements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $room = Room::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'floor' => $request->floor,
            'is_active' => $request->is_active,
            'building_id' => $request->building_id,
        ]);

        $room->equipements()->attach($request->equipements);
        return redirect()->route('admin.rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::with(['building', 'equipements'])->findOrFail($id);
        return view('admin.rooms.show', compact('room'));
    }

    public function edit(string $id)
    {
        $buildings = Building::all();
        $equipements = Equipement::all();
        $room = Room::with(['equipements'])->findOrFail($id);
        return view('admin.rooms.edit', compact('room', 'buildings', 'equipements'));
    }


    public function update(UpdateRoomRequest $request, string $id)
    {
        $room = Room::findOrFail($id);
        $room->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'floor' => $request->floor,
            'is_active' => $request->is_active,
            'building_id' => $request->building_id,
        ]);

        $room->equipements()->sync($request->equipements ?? []);

        return redirect()->route('admin.rooms.index')->with('success', 'room updated successfully.');

    }

    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->equipements()->detach();
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Deleted Succsusful');

    }
}
