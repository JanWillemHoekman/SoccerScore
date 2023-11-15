<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryExceptio;

use App\Models\Game;
use App\Models\Team;
use App\Models\Season;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $games = Game::all();

        return response()->json($games);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'homeTeam' => 'required|max:255',
            'awayTeam' => 'required|max:255',
            'season' => 'required|max:255',
            'homeScore' => 'required',
            'awayScore' => 'required',
        ]);

        $homeTeam = Team::where('name', '=', $request->get('homeTeam'))->first();
        $awayTeam = Team::where('name', '=', $request->get('awayTeam'))->first();
        $season = Season::where('name', '=', $request->get('season'))->first();
        $game = Game::where('homeTeam', '=', $homeTeam->id)
                        ->where('awayTeam', '=', $awayTeam->id)
                        ->where('season', '=', $season->id)
                        ->first();

        if($game !== null) {
            return response()->json("game " . $homeTeam->name . " against ".  $awayTeam->name . " for season " . $season->name . " already exists");
        }
        
        if ($homeTeam !== null && $awayTeam !== null && $season !== null) {
            Game::create([
                'homeTeam' => $homeTeam->id,
                'awayTeam' => $awayTeam->id,
                'season' => $season->id,
                'homeScore' => $request->get('homeScore'),
                'awayScore' => $request->get('awayScore')
            ]);
                    
            return response()->json("game " . $homeTeam->name . " against ".  $awayTeam->name . " for season " . $season->name . " created");
        }

        return response()->json("one of the following does not exist: " . $request->get('homeTeam') . ", ".  $request->get('awayTeam') . ", " . $request->get('season'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $request->validate([
            'homeTeam' => 'required|max:255',
            'awayTeam' => 'required|max:255',
            'season' => 'required|max:255'
        ]);

        $homeTeam = Team::where('name', '=', $request->get('homeTeam'))->first();
        $awayTeam = Team::where('name', '=', $request->get('awayTeam'))->first();
        $season = Season::where('name', '=', $request->get('season'))->first();
        $game = Game::where('homeTeam', '=', $homeTeam->id)
                        ->where('awayTeam', '=', $awayTeam->id)
                        ->where('season', '=', $season->id)
                        ->first();
                
        if ($game !== null) {
            return response()->json($game);
        }
        
        return response()->json("game does not exists");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'homeTeam' => 'required|max:255',
            'awayTeam' => 'required|max:255',
            'season' => 'required|max:255',
            'homeScore' => 'required',
            'awayScore' => 'required',
        ]);

        $homeTeam = Team::where('name', '=', $request->get('homeTeam'))->first();
        $awayTeam = Team::where('name', '=', $request->get('awayTeam'))->first();
        $season = Season::where('name', '=', $request->get('season'))->first();
        $game = Game::where('homeTeam', '=', $homeTeam->id)
                        ->where('awayTeam', '=', $awayTeam->id)
                        ->where('season', '=', $season->id)
                        ->first();

        if($game === null) {
            return response()->json("game " . $homeTeam->name . " against ".  $awayTeam->name . " for season " . $season->name . " does not exists");
        }
        
        if ($homeTeam !== null && $awayTeam !== null && $season !== null) {
            $game->update([
                'homeScore' => $request->get('homeScore'),
                'awayScore' => $request->get('awayScore')
            ]);
                    
            return response()->json("game " . $homeTeam->name . " against ".  $awayTeam->name . " for season " . $season->name . " updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'homeTeam' => 'required|max:255',
            'awayTeam' => 'required|max:255',
            'season' => 'required|max:255'
        ]);

        $homeTeam = Team::where('name', '=', $request->get('homeTeam'))->first();
        $awayTeam = Team::where('name', '=', $request->get('awayTeam'))->first();
        $season = Season::where('name', '=', $request->get('season'))->first();
        $game = Game::where('homeTeam', '=', $homeTeam->id)
                        ->where('awayTeam', '=', $awayTeam->id)
                        ->where('season', '=', $season->id)
                        ->first();
        
        if ($game !== null) {
            $game->delete();
            
            return response()->json("game " . $game . " destroyed");
        }

        return response()->json("game does not exist exists");
    }
}
