<?php

namespace App\Http\Controllers\Admin;

use App\Championship;
use App\Court;
use App\Http\Requests\StoreChampionshipRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChampionshipsController extends Controller
{
    public function index(){

        $championships = Championship::allowed()->get();

        return view('admin.championships.index', compact('championships'));
    }

    public function create()
    {
        $this->authorize('create', new Championship);

        return view('admin.championships.create');
    }

    public function store(Request $request){
        $this->authorize('create', new Championship);

        $this->validate($request, ['title' => 'required|min:3']);

        $Championship = Championship::create( $request->all() );

        return redirect()->route('admin.championships.edit', $Championship);
    }

    public function edit(Championship $Championship){

        $this->authorize('update', $Championship);

        return view('admin.championships.edit',[
            'championship' => $Championship,
            'courts' => Court::where('user_id',auth()->user()->id)->get(),
        ]);
    }

    public function update(Championship $championship, StoreChampionshipRequest $request)
    {

        $this->authorize('update', $championship);


        $championship->update($request->all());

        return redirect()
            ->route('admin.championships.edit', $championship)
            ->with('flash', 'La publicación ha sido guardada');

    }

    public function destroy(Championship $championship){

        $this->authorize('delete', $championship);

        $championship->delete();

        return redirect()->route('admin.championships.index')->with('flash', 'El campeonato ha sido eliminado ha sido eliminada');
    }

}
