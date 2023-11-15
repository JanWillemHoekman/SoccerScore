<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teams = Team::all();

        return response()->json($teams);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $team = Team::where('name', '=', $request->get('name'))->first();
        
        if ($team === null) {
            Team::create($request->all());
            
            return response()->json("team " . $request->get('name') . " created");
        }

        return response()->json("team " . $request->get('name') . " already exists");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        $team = Team::where('name', '=', $name)->first();
                
        if ($team !== null) {
            return response()->json($team);
        }
        
        return response()->json("team " . $name . " does not exists");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $name)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $team = Team::where('name', '=', $name)->first();
        $newTeam = Team::where('name', '=', $request->get('name'))->first();
        
        if ($team !== null && $newTeam === null) {
            $team->update($request->all());
            
            return response()->json("team " .$name . " is renamed to ". $request->get('name'));
        }

        return response()->json("team " . $name . " does not exist or team " . $request->get('name') . " already exists");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $name)
    {
        $team = Team::where('name', '=', $name)->first();
        
        if ($team !== null) {
            $team->delete();
            
            return response()->json("team " . $name . " destroyed");
        }

        return response()->json("team " . $name . " does not exist exists");
    }
}
