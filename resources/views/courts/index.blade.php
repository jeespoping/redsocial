@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse($courts as $court)
                <div class="col">
                    <div class="card mb-3" style="width: 20rem;">
                        <img src="{{ $court->photos->count() > 0 ? url('storage/'.$court->photos->first()->url) : '/img/no.jpg'}}"
                             class="card-img-top"
                             style="height: 14rem;"
                             alt="Error">
                        <div class="card-body">
                            <h5 class="card-title">{{ $court->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $court->category->name }}</h6>
                            <a href="{{ route('courts.show', $court) }}" class="btn btn-primary">Apartar cancha</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="h1">
                    <h1>No hay canchas todavia.</h1>
                </div>
            @endforelse
        </div>
    </div>
@stop