<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Sheet;
use App\Statistic;
use App\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{

    public function index(){
        $teams = Team::all();

        return view('teams.index', compact('teams'));
    }

    public function store(Championship $championship, Request $request){

        $this->validate($request, ['name' => 'required|min:3|unique:teams,name', 'user_id' => 'required|unique:teams,user_id']);

        $team = Team::create([
           'name' => $request->get('name'),
           'championship_id' => $championship->id,
            'user_id' => auth()->user()->id,
        ]);

        Statistic::create([
           'team_id' => $team->id
        ]);

        Sheet::create([
           'user_id' => auth()->user()->id,
           'team_id' => $team->id
        ]);

        return redirect()->route('teams.show', $team);
    }

    public function show(Team $team){

        $sheets = $team->sheets()->with('owner')->first()->owner()->first()->name;

        return view('teams.showw', compact('team'));
    }

}
