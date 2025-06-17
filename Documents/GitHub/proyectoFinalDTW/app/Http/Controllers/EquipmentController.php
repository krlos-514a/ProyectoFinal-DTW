<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Variable usada en la vista se llama $equipment, así que aquí también la usaré así
        $equipos = Equipment::paginate(10);
        return view('equipment.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'responsible' => 'required',
            'delivered_at' => 'required|date',
            'returned_at' => 'nullable|date|after_or_equal:delivered_at',
        ]);
    
        Equipment::create([
            'name' => $request->name,
            'responsible' => $request->responsible,
            'delivered_at' => $request->delivered_at,
            'returned_at' => $request->returned_at,
        ]);
    
        return redirect()->route('equipment.index')->with('success', 'Equipo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        return view('equipment.show', compact('equipment'));
    }

    
    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name' => 'required',
            'responsible' => 'required',
            'delivered_at' => 'required|date',
            'returned_at' => 'nullable|date|after_or_equal:delivered_at',
        ]);

        $equipment->update([
            'name' => $request->name,
            'responsible' => $request->responsible,
            'delivered_at' => $request->delivered_at,
            'returned_at' => $request->returned_at,
        ]);

        return redirect()->route('equipment.index')->with('success', 'Equipo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);
    $equipment->delete();

    return redirect()->route('equipment.index')->with('success', 'Equipo eliminado exitosamente.');
    }
}

