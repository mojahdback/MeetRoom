<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Http\Requests\Equipement\StoreEquipementRequest;
use App\Http\Requests\Equipement\UpdateEquipementRequest;


class EquipementController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipements = Equipement::all(); 
        return view('equipements.index', compact('equipements') );   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('equipements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipementRequest $request)
    {
        Equipement::create([
            'name' => $request->name,
            'type' => $request->type ,
            'description' => $request->description
        ]);

        return redirect()->route('equipements.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipement = Equipement::findOrFail($id);
        return view('equipements.show', compact('equipement') );
    }

    public function edit(string $id)
    {
        $equipement = Equipement::findOrFail($id);
        return view('equipements.edit', compact('equipement') );
    }

    
    public function update(UpdateEquipementRequest $request, string $id)
    {
        $equipement = Equipement::findOrFail($id);
        $equipement->update([
            'name' => $request->name,
            'type' => $request->type ,
            'description' => $request->description
        ]);

        return redirect()->route('equipements.index')->with('success', 'equipement updated successfully.');
        
    }

    public function destroy(string $id){
        $equipement = Equipement::findOrFail($id);
        $equipement->Delete();
        return redirect()->route('equipements.index')->with('success', 'Deleted Succsusful');
   
    }
    
}
