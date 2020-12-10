<?php

namespace App\Http\Controllers\Admin;

use App\Championship;
use App\Http\Requests\StoreEstatisticRequest;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    public function index(Championship $championship){


        return view('admin.teams.index',compact('championship'));
    }

    public function edit(Championship $championship, Team $team){
        $this->authorize('update', $championship);

        return view('admin.teams.edit',['championship' => $championship, 'team' => $team]);
    }

    public function update(Championship $championship, Team $team, StoreEstatisticRequest $request){

        $this->authorize('update', $championship);


        $team->statistic()->first()->update($request->all());

        return redirect()
            ->route('admin.statistics.edit', ['championship' => $championship, 'team' => $team])
            ->with('flash', 'Los datos han sido actualizados');
    }
}
