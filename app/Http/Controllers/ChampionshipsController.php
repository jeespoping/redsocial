<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Sheet;
use Illuminate\Http\Request;

class ChampionshipsController extends Controller
{
    public function index(){

        $query = Championship::published();

        $championships = $query->paginate();



        return view('championships.index', compact('championships'));
    }

    public function show(Championship $championship){

        $sheet = Sheet::where('user_id',auth()->user()->id)->count();

        if($championship->isPublished()){
            return view('championships.showw',['championship' => $championship, 'sheet' => $sheet]);
        }
        abort(404);
    }
}
