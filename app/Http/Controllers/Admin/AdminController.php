<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        if( !auth()->user()->hasRole('User')){
            return view('admin.dashboard');
        }
        abort(404);
    }
}
