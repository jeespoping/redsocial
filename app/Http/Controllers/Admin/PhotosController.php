<?php

namespace App\Http\Controllers\Admin;

use App\Court;
use App\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function store(Court $court){

        $this->validate(request(), [
            'photo' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);

        $court->photos()->create([
            'url' => request()->file('photo')->store('courts', 'public'),
        ]);
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();

        return back()->with('flash', 'Foto eliminada');
    }
}
