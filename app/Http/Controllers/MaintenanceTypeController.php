<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceType;
use Illuminate\Http\Request;

class MaintenanceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenanceTypes = MaintenanceType::all();
        return response()->json(['data' => $maintenanceTypes]);
    }
    public function maintenanceTypePagination()
    {
        $maintenanceTypes = MaintenanceType::paginate(request()->segment(count(request()->segments())));
        return response()->json(['data' => $maintenanceTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'name_loc' => 'required|max:255'
        ]);

        $maintenanceType = new MaintenanceType;
        $maintenanceType->name = $validatedData['name'];
        $maintenanceType->name_loc = $validatedData['name_loc'];
        $maintenanceType->save();

        return response()->json(['data' => $maintenanceType], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaintenanceType  $maintenanceType
     * @return \Illuminate\Http\Response
     */
    public function show(MaintenanceType $maintenanceType)
    {
        return response()->json(['data' => $maintenanceType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaintenanceType  $maintenanceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaintenanceType $maintenanceType)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'name_loc' => 'required|max:255'
        ]);
    
        $maintenanceType->name = $validatedData['name'];
        $maintenanceType->name_loc = $validatedData['name_loc'];
        $maintenanceType->save();
    
        return response()->json(['data' => $maintenanceType]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaintenanceType  $maintenanceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaintenanceType $maintenanceType)
    {
        $maintenanceType->delete();

        return response()->json(['message' => 'Maintenance type deleted']);
    }
}
