@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse($championships as $championship)
                <div class="col">
                    <div class="card mb-3" style="width: 20rem;">
                        <img src="{{ $championship->photoos->count() > 0 ? url('storage/'.$championship->photoos->first()->url) : '/img/no.jpg'}}"
                             class="card-img-top"
                             style="height: 14rem;"
                             alt="Error">
                        <div class="card-body">
                            <h5 class="card-title">{{ $championship->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $championship->court->title }}</h6>
                            <a href="{{ route('championships.show', $championship) }}" class="btn btn-primary">Ver Campeonato</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="h1">
                    <h1>No hay campeonatos todavia.</h1>
                </div>
            @endforelse
        </div>
    </div>
@stop