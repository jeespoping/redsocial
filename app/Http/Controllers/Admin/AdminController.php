<?php

namespace App\Http\Controllers\Admin;

use App\Championship;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){

        $user = auth()->user()->id;

        $teams = Team::with(['championship' => function($query) use($user){
            $query->where('user_id',$user);
        }]);


        if( !auth()->user()->hasRole('User')){
            return view('admin.dashboard', compact('teams'));
        }
        abort(404);
    }
}
