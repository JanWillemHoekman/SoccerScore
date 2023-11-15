<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;

class SeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $seasons = Season::all();

        return response()->json($seasons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $season = Season::where('name', '=', $request->get('name'))->first();
        
        if ($season === null) {
            Season::create($request->all());
            
            return response()->json("season " . $request->get('name') . " created");
        }

        return response()->json("season " . $request->get('name') . " already exists");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        $season = Season::where('name', '=', $name)->first();
                
        if ($season !== null) {
            return response()->json($season);
        }
        
        return response()->json("season " . $name . " does not exists");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $name)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $season = Season::where('name', '=', $name)->first();
        $newSeason = Season::where('name', '=', $request->get('name'))->first();
        
        if ($season !== null && $newSeason === null) {
            $season->update($request->all());
            
            return response()->json("season " .$name . " is renamed to ". $request->get('name'));
        }

        return response()->json("season " . $name . " does not exist or season " . $request->get('name') . " already exists");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $name)
    {
        $season = Season::where('name', '=', $name)->first();
        
        if ($season !== null) {
            $season->delete();
            
            return response()->json("season " . $name . " destroyed");
        }

        return response()->json("season " . $name . " does not exist exists");
    }
}
