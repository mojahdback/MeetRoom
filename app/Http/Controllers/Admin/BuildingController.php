<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Building\storeBuildingRequest;
use App\Http\Requests\Building\updateBuildingRequest;
use App\Models\Building;
use App\Models\Room;


class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = Building::all();
        return view('admin.buildings.index', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.buildings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeBuildingRequest $request)
    {
        Building::create([
            'name' => $request->name,
            'address' => $request->address,
            'floors_count' => $request->floors_count,
            'is_active' => $request->is_active,
        ]);


        return redirect()->route('admin.buildings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $building = Building::findOrFail($id);
        return view('admin.buildings.show', compact('building'));
    }

    public function edit(string $id)
    {
        $building = Building::findOrFail($id);
        return view('admin.buildings.edit', compact('building'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(updateBuildingRequest $request, string $id)
    {
        $building = Building::findOrFail($id);
        $building->update([
            'name' => $request->name,
            'address' => $request->address,
            'floors_count' => $request->floors_count,
            'is_active' => $request->is_active??false,
        ]);

        if($request->is_active == false){
            $building->rooms()->update([
                "is_active" => false 
            ]);

        }

        else{
             $building->rooms()->update([
                "is_active" => true 
            ]);

        }

        return redirect()->route('admin.buildings.index')->with('success', 'building updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(string $id)
    {
        $building = Building::findOrFail($id);
        $building->Delete();
        return redirect()->route('admin.buildings.index')->with('success', 'Deleted Succsusful');

    }


}
