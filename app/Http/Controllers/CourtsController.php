<?php

namespace App\Http\Controllers;

use App\Court;
use Illuminate\Http\Request;

class CourtsController extends Controller
{
    public function index(){
        $query = court::published();

        $courts = $query->paginate();

        return view('courts.index', compact('courts'));
    }

    public function show(Court $court){
        if($court->isPublished()){
            return view('courts.showw', compact('court'));
        }
        abort(404);
    }
}
