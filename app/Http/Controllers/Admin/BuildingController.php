<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Building\storeBuildingRequest;
use App\Http\Requests\updateBuildingRequest;
use App\Models\Building;


class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = Building::all(); 
        return view('buildings.index', compact('buildings') );   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('buildings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeBuildingRequest $request)
    {
        Building::create([
            'name' => $request->name,
            'address' => $request->address ,
            'floors_count' => $request->floors_count,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('buildings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $building = Building::findOrFail($id);
        return view('buildings.show', compact('building') );
    }

    public function edit(string $id)
    {
        $building = Building::findOrFail($id);
        return view('buildings.edit', compact('building') );
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(updateBuildingRequest $request, string $id)
    {
        $building = Building::findOrFail($id);
        $building->update([
            'name' => $request->name,
            'address' => $request->address ,
            'floors_count' => $request->floors_count,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('buildings.index')->with('success', 'building updated successfully.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
  
 
    public function destroy(string $id){
        $building = Building::findOrFail($id);
        $building->Delete();
        return redirect()->route('buildings.index')->with('success', 'Deleted Succsusful');
   
    }
}
