@extends('Admin.layout')

@section('header')

    <h1>
        Equipos de: {{ $championship->title }}
        <smal>Listado</smal>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Inicio</a></li>
    </ol>

@stop

@section('content')

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de equipos</h3>
        </div>
        {{--    box-header--}}

        <div class="box-body">
            <table id="championships-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>nombre</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($championship->teams as $team)
                    <tr>
                        <td>{{ $team->id }}</td>
                        <td>{{ $team->name }}</td>
                        <td>

{{--                            <a href="{{ route('admin.statistics.index', $championship) }}"--}}
{{--                               class="btn btn-xs btn-default"--}}
{{--                               target="_blank"--}}
{{--                            ><i class="fa fa-eye"></i></a>--}}

                            <a href="{{ route('admin.statistics.edit', ['championship' => $championship, 'team' => $team]) }}" class="btn btn-xs btn-info">
                                <i class="fa fa-pencil"></i>
                            </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop