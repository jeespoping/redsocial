<?php

namespace App\Http\Controllers;

use App\Sheet;
use App\Team;
use Illuminate\Http\Request;

class SheetsController extends Controller
{
    public function store(Request $request, Team $team){

        $this->validate($request, ['user_id' => 'required']);


        foreach ($request->get('user_id') as $user){
            Sheet::create([
                'team_id' => $team->id,
                'user_id' => $user
            ]);
        }

        return redirect()->route('teams.show', $team);
    }

    public function destroy(Sheet $sheet, Team $team){

        $this->authorize('delete',[$sheet,$team]);

        if ($team->user_id === $sheet->user_id){
            $team->delete();
            return redirect()->route('championshipss.index');
        }
        $sheet->delete();
        return redirect()->route('teams.show',$team);
    }
}
