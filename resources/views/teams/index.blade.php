@extends('layouts.app')

@section('content')

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de equipos</h3>
        </div>
        <div class="box-body">
            <table id="teams-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Campeonato</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                        @if($team->sheets()->where('user_id',auth()->user()->id)->count() > 0)
                            <tr>
                                <td>{{$team->name}}</td>
                                <td>{{$team->championship()->first()->title}}</td>
                                <td>
                                    <a href="{{ route('teams.show', $team) }}"
                                       class="btn btn-xs btn-default"
                                       target="_blank"
                                    ><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop