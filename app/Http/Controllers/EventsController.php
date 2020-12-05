<?php

namespace App\Http\Controllers;

use App\Court;
use App\Event;
use App\Http\Requests\StoreEventRequest;
use \Illuminate\Support\Carbon;

class EventsController extends Controller
{
    public function store(StoreEventRequest $request, Court $court){

        Event::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'color' => '#1abc9c',
            'textColor' => '#2c3e50',
            'start' => Carbon::parse($request->get('start')),
            'end' => Carbon::parse($request->get('start'))->addHour(),
            'court_id' => $court->id,
            'user_id' => auth()->user()->id,
        ]);

    }

    public function show(Court $court){
        $data['events'] = $court->events()->get();
        return response()->json($data['events']);
    }

    public function destroy(Court $court, Event $event){
        $event->delete();
    }

    public function update(StoreEventRequest $request, Court $court, Event $event){
        $respuesta = $event->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'color' => '#1abc9c',
            'textColor' => '#2c3e50',
            'start' => Carbon::parse($request->get('start')),
            'end' => Carbon::parse($request->get('start'))->addHour(),
            'court_id' => $court->id,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json($respuesta);
    }

}
