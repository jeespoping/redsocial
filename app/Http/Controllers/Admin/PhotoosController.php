<?php

namespace App\Http\Controllers\Admin;

use App\Championship;
use App\Photoo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoosController extends Controller
{
    public function store(Championship $championship){

        $this->validate(request(), [
            'photoo' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);

        $championship->photoos()->create([
            'url' => request()->file('photoo')->store('championships', 'public'),
        ]);
    }

    public function destroy(Photoo $photoo)
    {
        $photoo->delete();

        return back()->with('flash', 'Foto eliminada');
    }
}
