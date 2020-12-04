<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Court;
use App\Http\Requests\StoreCourtRequest;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourtsController extends Controller
{
    public function index()
    {

        $courts = court::allowed()->get();

        return view('admin.courts.index', compact('courts'));
    }

    public function store(Request $request){
        $this->authorize('create', new Court);

        $this->validate($request, ['title' => 'required|min:3']);

        $court = Court::create( $request->all() );

        return redirect()->route('admin.courts.edit', $court);
    }

    public function edit(Court $court){

        $this->authorize('update', $court);

        return view('admin.courts.edit',[
           'court' => $court,
           'categories' => Category::all()
        ]);
    }

    public function update(Court $court, StoreCourtRequest $request)
    {
        $this->authorize('update', $court);

        $court->update($request->all());

        return redirect()
            ->route('admin.courts.edit', $court)
            ->with('flash', 'La publicación ha sido guardada');
    }

    public function destroy(Court $court){
        $this->authorize('delete', $court);

        $court->delete();

        return redirect()->route('admin.courts.index')->with('flash', 'La cancha ha sido eliminada');
    }
}
