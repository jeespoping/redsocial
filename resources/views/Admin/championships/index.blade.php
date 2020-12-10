@extends('Admin.layout')

@section('header')

    <h1>
        Campeonatos
        <smal>Listado</smal>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Inicio</a></li>
    </ol>

@stop

@section('content')

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de campeonatos</h3>
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal2">
                <i class="fa fa-plus"></i> Crear campeonato
            </button>
        </div>
        {{--    box-header--}}

        <div class="box-body">
            <table id="championships-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($championships as $championship)
                    <tr>
                        <td>{{ $championship->id }}</td>
                        <td>{{ $championship->title }}</td>
                        <td>

                            <a href="{{ route('admin.statistics.index', $championship) }}"
                               class="btn btn-xs btn-default"
                               target="_blank"
                            ><i class="fa fa-eye"></i></a>

                            <a href="{{ route('admin.championships.edit', $championship) }}" class="btn btn-xs btn-info">
                                <i class="fa fa-pencil"></i>
                            </a>

                            {{--                            Eliminar canchas--}}
                            <form action="{{ route('admin.championships.destroy', $championship) }}" method="post" style="display: inline">
                                @csrf @method('DELETE')
                                <button
                                        class="btn btn-xs btn-danger"
                                        onclick="return confirm('Estas seguro de querer eliminar este campeonato?')"
                                ><i class="fa fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@push('styles')
    <link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css">
@endpush

@push('scripts')
    <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $("#championships-table").DataTable();
        });
    </script>
@endpush